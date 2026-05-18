<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        $logs = DB::table('logs')
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        $totalUsuarios = Usuario::count();

        $totalClientes = Usuario::where('id_rol', 2)->count();

        $totalEmpleados = Usuario::where('id_rol', 3)->count();

        $logsHoy = DB::table('logs')
            ->whereDate('fecha', now())
            ->count();

        return view('admin.dashboard', compact(
            'usuarios',
            'logs',
            'totalUsuarios',
            'totalClientes',
            'totalEmpleados',
            'logsHoy'
        ));
    }

    public function formEmpleado()
    {
        return view('admin.registro_empleado');
    }

    public function guardarEmpleado(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:usuarios,correo',
            'telefono' => 'required',
            'cargo' => 'required|in:Groomer,Recepcionista',
            'turno' => 'required|in:Mañana,Tarde,Noche',
        ], [
            'correo.unique' => 'Este correo ya está registrado'
        ]);

        // contraseña automática
        $passwordTemporal =
            strtolower($request->nombres)
            .
            strtolower($request->apellidos)
            .
            '2026';

        $usuario = Usuario::create([
            'id_rol' => 3,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contrasena' => Hash::make($passwordTemporal),
            'estado' => 'activo',
            'primer_login' => true
        ]);

        DB::table('empleados')->insert([
            'id_usuario' => $usuario->id_usuario,
            'cargo' => $request->cargo,
            'turno' => $request->turno,
            'fecha_ingreso' => now()
        ]);

        return redirect('/admin')
            ->with(
                'success',
                'Empleado registrado correctamente'
            );
    }
}