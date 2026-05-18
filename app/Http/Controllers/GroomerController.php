<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Cita;
use App\Models\Empleado;

class GroomerController extends Controller
{

    public function agenda()
    {

        $usuario=
        Auth::user();

        $empleado=

        Empleado::where(
            'id_usuario',
            $usuario->id_usuario
        )

        ->first();

        $citas=

        Cita::join(
            'mascotas',
            'citas.id_mascota',
            '=',
            'mascotas.id_mascota'
        )

        ->join(
            'servicios',
            'citas.id_servicio',
            '=',
            'servicios.id_servicio'
        )

        ->select(
            'citas.*',
            'mascotas.nombre as mascota',
            'servicios.nombre as servicio'
        )

        ->where(
            'citas.id_empleado',
            $empleado->id_empleado
        )

        ->orderBy(
            'fecha'
        )

        ->orderBy(
            'hora_inicio'
        )

        ->get();

        return view(
            'groomer.agenda',
            compact(
                'citas'
            )
        );

    }

}