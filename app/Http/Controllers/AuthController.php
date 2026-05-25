<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Cliente;
//para el gugul
use Laravel\Socialite\Facades\Socialite;

//para enviar correos
use Illuminate\Support\Facades\Mail;

//2fa
use PragmaRX\Google2FAQRCode\Google2FA;

//para log
use App\Helpers\LogHelper;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        LogHelper::registrar('Intento de inicio de sesión');

        $usuario = Usuario::where('correo', $request->correo)->first();

        // ❌ Usuario no existe
        if (!$usuario) {
            LogHelper::registrar('Usuario no existe');
            return back()->with('error', 'Usuario no existe');
        }

        // 🔓 Reset bloqueo si ya expiró
        if ($usuario->bloqueado_hasta && now()->gt($usuario->bloqueado_hasta)) {
            $usuario->intentos_fallidos = 0;
            $usuario->bloqueado_hasta = null;
            $usuario->save();
        }

        // 🔒 Si está bloqueado
        if ($usuario->bloqueado_hasta && now()->lt($usuario->bloqueado_hasta)) {
            $segundos = (int) now()->diffInSeconds($usuario->bloqueado_hasta);

            return back()->with(
                'error',
                "Cuenta bloqueada. Intenta nuevamente en $segundos segundos"
            );
        }

        // 🚫 cuenta inactiva
        if ($usuario->estado != 'activo') {
            LogHelper::registrar('Intento con cuenta inactiva');

            return back()->with(
                'error',
                'Cuenta inactiva, revisar correo'
            );
        }

        // =========================
        // 🔑 CONTRASEÑA CORRECTA
        // =========================
        if (Hash::check($request->password, $usuario->contrasena)) {

            LogHelper::registrar('Inicio de sesión exitoso');

            // reset intentos
            $usuario->intentos_fallidos = 0;
            $usuario->bloqueado_hasta = null;
            $usuario->save();

            // =========================
            // 🔐 ADMIN (2FA)
            // =========================
            if ($usuario->id_rol == 1) {

                $codigo = rand(100000, 999999);

                $usuario->codigo_2fa = $codigo;
                $usuario->codigo_2fa_expira = now()->addMinutes(5);
                $usuario->save();

                Mail::raw("Tu código es: $codigo", function ($message) use ($usuario) {
                    $message->to($usuario->correo)
                            ->subject('Código 2FA');
                });

                session([
                    '2fa_admin_id' => $usuario->id_usuario
                ]);

                return redirect('/verificar-2fa');
            }

            // =========================
            // LOGIN NORMAL
            // =========================
            Auth::login($usuario);

            switch ($usuario->id_rol) {

                // CLIENTE
                case 2:
                    return redirect('/cliente');

                // EMPLEADO GENERAL (fallback)
                case 3:
                    return redirect('/personal');

                // RECEPCIÓN (NUEVO)
                case 4:
                    return redirect('/recepcion');

                default:
                    return redirect('/');
            }
        }

        // =========================
        // ❌ CONTRASEÑA INCORRECTA
        // =========================
        $usuario->intentos_fallidos++;

        if ($usuario->intentos_fallidos >= 5) {
            $usuario->bloqueado_hasta = now()->addSeconds(30);
            LogHelper::registrar('Cuenta bloqueada temporalmente');
        }

        $usuario->save();

        $restantes = 5 - $usuario->intentos_fallidos;

        LogHelper::registrar('Contraseña incorrecta');

        return back()->with(
            'error',
            "Contraseña incorrecta. Te quedan $restantes intentos"
        );
    }

    public function logout()
    {
        LogHelper::registrar('Cierre de sesión');
        Auth::logout();
        return redirect('/login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        //verificacion de passwoard
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:usuarios,correo',
            'telefono' => 'required',

            // 🔐 PASSWORD SEGURA
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',      // minúscula
                'regex:/[A-Z]/',      // mayúscula
                'regex:/[0-9]/',      // número
                'regex:/[@$!%*#?&]/', // símbolo
            ]
        ], [
            'correo.unique' => 'Este correo ya está registrado',
            'password.min' => 'Mínimo 8 caracteres',
            'password.regex' => 'Debe incluir mayúsculas, minúsculas, números y símbolos',
            'password.confirmed' =>'Las contraseñas no coinciden'
        ]);
        $usuario = Usuario::create([
            'id_rol' => 2, // cliente
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contrasena' => Hash::make($request->password),
            'estado' => 'inactivo'
        ]);
        LogHelper::registrar('Registro de nuevo usuario');
        DB::table('clientes')->insert([
            'id_usuario' => $usuario->id_usuario,
            'direccion' => $request->direccion
        ]);
        // 🔐 Generar token
        $token = Str::random(60);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->correo,
            'token' => $token,
            'created_at' => now()
        ]);

        // 🔗 Link de activación
        $link = url("/activar/$token");

        // 📩 Enviar correo
        Mail::raw("Activa tu cuenta aquí: $link", function ($message) use ($request) {
            $message->to($request->correo)
                    ->subject('Activación de cuenta - Spa');
        });

        return redirect('/login')->with('success', 'Cuenta creada, revisa el correo que te enviamos para activar tu cuenta');
    }

    public function activarCuenta($token)
    {
        $registro = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$registro) {
            return "Token inválido";
        }

        // ⏱ Expira en 15 minutos
        if (now()->diffInMinutes($registro->created_at) > 15) {
            return "Token expirado";
        }

        $usuario = Usuario::where('correo', $registro->email)->first();

        if ($usuario) {
            $usuario->estado = 'activo';
            $usuario->save();
        }

        DB::table('password_reset_tokens')
            ->where('email', $registro->email)
            ->delete();

        return "Cuenta activada correctamente";
    }

    //para el gugul
    //metodo para la solicitud
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    //metodo pa cuando el gugul responde
    public function handleGoogle()
    {
        $googleUser = Socialite::driver('google')->user();

        $usuario = Usuario::where('correo', $googleUser->getEmail())->first();

        if (!$usuario) {

            $usuario = Usuario::create([

                'id_rol' => 2,

                'nombres' => $googleUser->getName(),

                'apellidos' => '',

                'correo' => $googleUser->getEmail(),

                'telefono' => '',

                'contrasena' => bcrypt('google'),

                'estado' => 'activo'

            ]);

            Cliente::create([

                'id_usuario' => $usuario->id_usuario,

                'direccion' => ''

            ]);

        }

        Auth::login($usuario);

        return redirect('/cliente');
    }

    public function guardarNuevaPassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ]
        ], [
            'password.min' => 'Mínimo 8 caracteres',
            'password.regex' => 'Debe incluir mayúsculas, minúsculas, números y símbolos',
            'password.confirmed' =>'Las contraseñas no coinciden'
        ]);

        $usuario = Auth::user();

        $usuario->contrasena = Hash::make($request->password);

        // 🔥 IMPORTANTE
        $usuario->primer_login = false;

        $usuario->save();

        return response()->json([
            'success' => true
        ]);
    }

    //metodos para el 2fa
    public function form2FA()
    {
        // si no hay sesión temporal
        if (!session('2fa_admin_id')) {

            return redirect('/login');
        }

        return view('auth.verificar2fa');
    }
    public function verificar2FA(Request $request)
    {
        $usuario = Usuario::find(
            session('2fa_admin_id')
        );

        if (!$usuario) {

            return redirect('/login');
        }

        // código expirado
        if (
            now()->greaterThan(
                $usuario->codigo_2fa_expira
            )
        ) {

            return back()->with(
                'error',
                'El código expiró'
            );
        }

        // código incorrecto
        if (
            $request->codigo !=
            $usuario->codigo_2fa
        ) {

            return back()->with(
                'error',
                'Código incorrecto'
            );
        }

        // limpiar código
        $usuario->codigo_2fa = null;
        $usuario->codigo_2fa_expira = null;

        $usuario->save();

        // 🔥 RECIÉN AQUÍ inicia sesión
        Auth::login($usuario);

        // borrar sesión temporal
        session()->forget('2fa_admin_id');

        return redirect('/admin');
    }
    public function reenviar2FA()
    {
        $usuario = Usuario::find(
            session('2fa_admin_id')
        );

        if (!$usuario) {

            return redirect('/login');
        }

        $codigo = rand(100000, 999999);

        $usuario->codigo_2fa = $codigo;

        $usuario->codigo_2fa_expira =
            now()->addMinutes(5);

        $usuario->save();

        Mail::raw(
            "Tu nuevo código es: $codigo",
            function ($message) use ($usuario) {

                $message->to($usuario->correo)
                        ->subject('Nuevo código 2FA');
            }
        );

        return back()->with(
            'success',
            'Código reenviado'
        );
    }
}