<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cita;
use App\Models\Mascota;
use App\Models\Servicio;
use App\Models\Empleado;

use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{

    public function index()
    {
        $citas = DB::table('citas')

            ->join(
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

            ->get();

        return view(
            'agenda.index',
            compact(
                'citas'
            )
        );
    }
    public function create()
    {
        $mascotas = DB::table('mascotas')
            ->get();

        $servicios = DB::table('servicios')
            ->where(
                'estado',
                'activo'
            )
            ->get();

        $groomers = DB::table('empleados')

            ->join(
                'usuarios',
                'empleados.id_usuario',
                '=',
                'usuarios.id_usuario'
            )

            ->select(
                'empleados.id_empleado',
                'usuarios.nombres',
                'usuarios.apellidos'
            )

            ->where(
                'empleados.cargo',
                'Groomer'
            )

            ->get();

        return view(
            'agenda.create',
            compact(
                'mascotas',
                'servicios',
                'groomers'
            )
        );
    }

    public function store(Request $request)
    {
        $mascota = Mascota::find(
            $request->id_mascota
        );

        $servicio = Servicio::find(
            $request->id_servicio
        );

        $duracion = $servicio->duracion_minutos;

        // AJUSTE POR TAMAÑO

        switch($mascota->tamano){

            case 'mediana':

                $duracion *= 1.10;

            break;

            case 'grande':

                $duracion *= 1.15;

            break;

            case 'gigante':

                $duracion *= 1.30;

            break;

        }

        // AJUSTE POR TEMPERAMENTO

        if(

            $mascota->temperamento_general == 'nervioso'

            ||

            $mascota->temperamento_general == 'agresivo'

        ){

            $duracion += 20;

        }

        $duracion = ceil($duracion);

        $inicio = strtotime(
            $request->hora_inicio
        );

        $fin = date(

            'H:i:s',

            $inicio + ($duracion * 60)

        );

        // VALIDAR SOLAPAMIENTO

        $ocupado = Cita::where(

            'id_empleado',
            $request->id_empleado

        )

        ->where(
            'fecha',
            $request->fecha
        )

        ->where(function($q)

        use(
            $request,
            $fin
        ){

            $q->whereBetween(

                'hora_inicio',

                [

                    $request->hora_inicio,

                    $fin

                ]

            )

            ->orWhereBetween(

                'hora_fin',

                [

                    $request->hora_inicio,

                    $fin

                ]

            );

        })

        ->exists();

        if($ocupado){

            return back()->with(

                'error',

                'Horario ocupado'

            );

        }

        // CONVERTIR DIA INGLES → ESPAÑOL

        $dias = [

            'Monday' => 'Lunes',

            'Tuesday' => 'Martes',

            'Wednesday' => 'Miercoles',

            'Thursday' => 'Jueves',

            'Friday' => 'Viernes',

            'Saturday' => 'Sabado',

            'Sunday' => 'Domingo'

        ];

        $dia = $dias[
            date(
                'l',
                strtotime(
                    $request->fecha
                )
            )
        ];

        // BUSCAR DISPONIBILIDAD

        $disp = DB::table(
            'disponibilidad_empleado'
        )

        ->where(
            'id_empleado',
            $request->id_empleado
        )

        ->where(
            'dia_semana',
            $dia
        )

        ->first();

        if(!$disp){

            return back()->with(

                'error',

                'Groomer sin disponibilidad'

            );

        }

        // VALIDAR HORARIO DISPONIBLE

        if(

            $request->hora_inicio
            < $disp->hora_inicio

            ||

            $fin > $disp->hora_fin

        ){

            return back()->with(

                'error',

                'Fuera del horario disponible'

            );

        }

        Cita::create([

            'id_mascota' =>
            $request->id_mascota,

            'id_servicio' =>
            $request->id_servicio,

            'id_empleado' =>
            $request->id_empleado,

            'fecha' =>
            $request->fecha,

            'hora_inicio' =>
            $request->hora_inicio,

            'hora_fin' =>
            $fin,

            'duracion_estimada_minutos' =>
            $duracion,

            'estado' =>
            'reservado'

        ]);

        return redirect(
            '/agenda'
        )

        ->with(
            'success',
            'Cita registrada'
        );
    }
    public function calendario()
    {

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

        ->get();

        return view(
            'agenda.calendario',
            compact(
                'citas'
            )
        );

    }
    public function mover(
        Request $request,
        $id
    )
    {

        $cita=
        Cita::find($id);

        $inicio=
        sprintf(

            '%02d:00:00',

            $request->hora

        );

        $fecha=

        now()

        ->startOfWeek()

        ->addDays(
            $request->dia-1
        )

        ->format(
            'Y-m-d'
        );

        $fin=

        date(

            'H:i:s',

            strtotime(
                $inicio
            )

            +

            (
                $cita
                ->duracion_estimada_minutos
                *60
            )

        );

        $ocupado=

        Cita::where(
            'id_empleado',
            $cita->id_empleado
        )

        ->where(
            'fecha',
            $fecha
        )

        ->where(
            'id_cita',
            '!=',
            $id
        )

        ->where(function($q)

        use(
            $inicio,
            $fin
        ){

            $q->whereBetween(
                'hora_inicio',
                [
                    $inicio,
                    $fin
                ]
            )

            ->orWhereBetween(
                'hora_fin',
                [
                    $inicio,
                    $fin
                ]
            );

        })

        ->exists();

        if($ocupado){

            return response()->json([

                'ok'=>false

            ]);

        }

        $cita->fecha=
        $fecha;

        $cita->hora_inicio=
        $inicio;

        $cita->hora_fin=
        $fin;

        $cita->save();

        return response()->json([

            'ok'=>true

        ]);

    }
}