<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PersonalController;

use App\Http\Controllers\ServicioController;
use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\GroomerController;

use App\Http\Controllers\MascotaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\BloqueoController;
use App\Models\Usuario;

Route::get('/', function () {

    if (auth()->check()) {

        switch(auth()->user()->id_rol){

            case 1:
                return redirect('/admin');

            case 2:
                return redirect('/cliente');

            case 3:
                return redirect('/personal');
        }
    }

    return view('welcome');
});
// AUTH
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/registro', [AuthController::class, 'showRegister']);
    Route::post('/registro', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout']);

// DASHBOARDS
Route::get('/admin', [AdminController::class, 'index'])->middleware('role:1');
Route::get('/cliente', [ClienteController::class, 'index'])->middleware('role:2');
Route::get('/personal', [PersonalController::class, 'index'])->middleware('role:3');

// REGISTRO EMPLEADOS (SOLO ADMIN)
Route::get('/admin/empleados', [AdminController::class, 'formEmpleado'])->middleware('role:1');
Route::post('/admin/empleados', [AdminController::class, 'guardarEmpleado'])->middleware('role:1');


//google continuar
Route::get('/auth/google', [AuthController::class, 'redirectGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogle']);

//para mandar correos
Route::get('/activar/{token}', [AuthController::class, 'activarCuenta']);

//cambiar contraseña Empleado por primera vez
Route::post('/cambiar-password', [AuthController::class, 'guardarNuevaPassword'])->middleware('auth');

//2FA para el admin
Route::get('/verificar-2fa', [AuthController::class, 'form2FA']);
Route::post('/verificar-2fa', [AuthController::class, 'verificar2FA']);

Route::post('/reenviar-2fa', [AuthController::class, 'reenviar2FA']);

Route::get('/cuenta', [ClienteController::class, 'cuenta'])
    ->middleware('role:2');


Route::get(
    '/admin/empleados/create',
    [AdminController::class, 'formEmpleado']
)->middleware('role:1');
// SERVICIOS
Route::get(
    '/admin/servicios',
    [ServicioController::class, 'index']
)->middleware('role:1');

Route::get(
    '/admin/servicios/create',
    [ServicioController::class, 'create']
)->middleware('role:1');

Route::post(
    '/admin/servicios/store',
    [ServicioController::class, 'store']
)->middleware('role:1');

Route::get(
    '/admin/servicios/edit/{id}',
    [ServicioController::class, 'edit']
)->middleware('role:1');


Route::post(

'/agenda/cancelar/{id}',

[AgendaController::class,'cancelar']

);

Route::post(
    '/admin/servicios/update/{id}',
    [ServicioController::class, 'update']
)->middleware('role:1');

Route::get(
'/disponibilidad',
[DisponibilidadController::class,'index']
);

Route::post(
'/disponibilidad',
[DisponibilidadController::class,'store']
);
Route::get(
'/disponibilidad/create',
[DisponibilidadController::class,'create']
);

Route::get(
'/disponibilidad/{id}/edit',
[DisponibilidadController::class,'edit']
);

Route::put(
'/disponibilidad/{id}',
[DisponibilidadController::class,'update']
);

Route::delete(
'/disponibilidad/{id}',
[DisponibilidadController::class,'destroy']
);

Route::get(
'/agenda',
[AgendaController::class,'index']
);

Route::get(
'/agenda/create',
[AgendaController::class,'create']
);

Route::post(
'/agenda',
[AgendaController::class,'store']
);

Route::get(
'/agenda/{id}/edit',
[AgendaController::class,'edit']
);

Route::put(
'/agenda/{id}',
[AgendaController::class,'update']
);
Route::get(
'/agenda/calendario',
[AgendaController::class,'calendario']
);
Route::post(

'/agenda/mover/{id}',

[AgendaController::class,'mover']

);

Route::get(

'/groomer/agenda',

[GroomerController::class,'agenda']

)

->middleware('auth');


Route::post(

'/mascotas',

[MascotaController::class,'store']

)->middleware('role:2');


Route::post(

'/mascotas/{id}',

[MascotaController::class,'update']

)->middleware('role:2');


Route::delete(

'/mascotas/{id}',

[MascotaController::class,'destroy']

)->middleware('role:2');

Route::get(

'/bloqueos',

[BloqueoController::class,'index']

);

Route::get(

'/bloqueos/create',

[BloqueoController::class,'create']

);

Route::post(

'/bloqueos',

[BloqueoController::class,'store']

);

//solicitudes
Route::post('/solicitudes', [SolicitudController::class, 'store']);

Route::middleware('role:4')->group(function () {

    Route::get('/recepcion', [RecepcionController::class, 'index']);

    Route::get('/recepcion/solicitudes', [RecepcionController::class, 'solicitudes']);

    Route::get('/recepcion/solicitud/{id}/tomar', [RecepcionController::class, 'tomarSolicitud']);

    Route::get('/recepcion/solicitud/{id}/convertir', [RecepcionController::class, 'convertirSolicitud']);

    Route::get('/recepcion/cita/{id}/pago', [RecepcionController::class, 'registrarPago']);

    Route::get('/recepcion/cita/{id}/cancelar', [RecepcionController::class, 'cancelarCita']);
});

Route::get('/recepcion/agenda', [RecepcionController::class, 'agenda'])
    ->middleware('role:4');