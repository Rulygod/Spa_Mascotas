<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Cita;
use App\Models\Mascota;
use App\Models\Servicio;
use App\Models\Empleado;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{

    public function index()
    {
        $citas = Cita::with([
            'mascota',
            'servicio'
        ])
        ->orderBy('fecha', 'asc')
        ->get();

        return view('agenda.index', compact('citas'));
    }
    public function create(Request $request)
    {
        $mascotas = DB::table('mascotas')->get();

        $servicios = DB::table('servicios')
            ->where('estado', 'activo')
            ->get();

        $groomers = DB::table('empleados')
            ->join('usuarios', 'empleados.id_usuario', '=', 'usuarios.id_usuario')
            ->select(
                'empleados.id_empleado',
                'usuarios.nombres',
                'usuarios.apellidos'
            )
            ->where('empleados.cargo', 'Groomer')
            ->get();

        // 🔥 SOLICITUD (SI VIENE DEL BOTÓN)
        $solicitud = null;

        if ($request->has('solicitud')) {

            $solicitud = Solicitud::with('cliente', 'mascota', 'servicio')
                ->find($request->solicitud);

            if ($solicitud) {
                $solicitud->estado = 'en_proceso';
                $solicitud->save();
            }
        }

        return view('agenda.create', compact(
            'mascotas',
            'servicios',
            'groomers',
            'solicitud'
        ));
    }

    public function store(Request $request)
{
    $mascota = Mascota::find($request->id_mascota);
    $servicio = Servicio::find($request->id_servicio);

    $duracion = $servicio->duracion_minutos;

    if ($mascota->tamano == 'mediana') $duracion *= 1.10;
    if ($mascota->tamano == 'grande') $duracion *= 1.15;
    if ($mascota->tamano == 'gigante') $duracion *= 1.30;

    if (in_array($mascota->temperamento_general, ['nervioso', 'agresivo'])) {
        $duracion += 20;
    }

    $duracion = ceil($duracion);

    $fin = $this->calcularFin($request->hora_inicio, $duracion);

    // BLOQUEO
    if ($bloqueo = $this->validarBloqueo($request->fecha)) {
        return back()->with('error', 'Día bloqueado: ' . $bloqueo->motivo);
    }

    // SOLAPAMIENTO
    if ($this->haySolapamiento($request->id_empleado, $request->fecha, $request->hora_inicio, $fin)) {
        return back()->with('error', 'Horario ocupado');
    }

    // DIA
    $dias = [
        'Monday'=>'lunes',
        'Tuesday'=>'martes',
        'Wednesday'=>'miércoles',
        'Thursday'=>'jueves',
        'Friday'=>'viernes',
        'Saturday'=>'sábado',
        'Sunday'=>'domingo'
    ];

    $dia = $dias[date('l', strtotime($request->fecha))];

    $disp = $this->obtenerDisponibilidad($request->id_empleado, $dia);

    if (!$disp) {
        return back()->with('error', 'Groomer no tiene horario');
    }

    if ($request->hora_inicio < $disp->hora_inicio || $fin > $disp->hora_fin) {
        return back()->with('error', 'Fuera del horario del groomer');
    }

    Cita::create([
        'id_mascota' => $request->id_mascota,
        'id_servicio' => $request->id_servicio,
        'id_empleado' => $request->id_empleado,
        'fecha' => $request->fecha,
        'hora_inicio' => $request->hora_inicio,
        'hora_fin' => $fin,
        'duracion_estimada_minutos' => $duracion,
        'estado' => 'reservado'
    ]);

    return redirect('/agenda')->with('success', 'Cita registrada');
}
    public function calendario(Request $request)
    {
        $inicioSemana =

        $request->semana

        ?

        Carbon::parse(
            trim(
                $request->semana
            )
        )->startOfWeek()

        :

        now()->startOfWeek();

        $finSemana =

        $inicioSemana
        ->copy()
        ->endOfWeek();

        $citas =

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

        ->whereBetween(
            'fecha',
            [
                $inicioSemana->format('Y-m-d'),
                $finSemana->format('Y-m-d')
            ]
        )

        ->get();

        return view(

            'agenda.calendario',

            compact(

                'citas',

                'inicioSemana',

                'finSemana'

            )

        );
    }
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);

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
            'agenda.edit',
            compact(
                'cita',
                'mascotas',
                'servicios',
                'groomers'
            )
        );
    }


    public function mover(
    Request $request,
        $id
    )
    {
        $cita = Cita::findOrFail($id);

        $inicio = sprintf(
            '%02d:00:00',
            $request->hora
        );

        $fecha=
$request->fecha;

        // calcular hora fin

        $fin = date(

            'H:i:s',

            strtotime($inicio)

            +

            (

                $cita->duracion_estimada_minutos
                *60

            )

        );

        // ==========================
        // BLOQUEOS / FERIADOS
        // ==========================

        $bloqueo = DB::table(
            'bloqueos_horario'
        )

        ->where(
            'fecha',
            $fecha
        )

        ->where(
            'estado',
            'activo'
        )

        ->first();

        if($bloqueo){

            return response()->json([

                'ok'=>false,

                'msg'=>

                'Fecha bloqueada: '

                .$bloqueo->motivo

            ]);

        }

        // ==========================
        // DISPONIBILIDAD GROOMER
        // ==========================

        $dias=[

            'Monday'=>'Lunes',
            'Tuesday'=>'Martes',
            'Wednesday'=>'Miércoles',
            'Thursday'=>'Jueves',
            'Friday'=>'Viernes',
            'Saturday'=>'Sábado',
            'Sunday'=>'Domingo'

        ];

        $diaSemana =

        $dias[
            date(
                'l',
                strtotime($fecha)
            )
        ];

        $disp = DB::table(
            'disponibilidad_empleado'
        )

        ->where(
            'id_empleado',
            $cita->id_empleado
        )

        ->where(
            'dia_semana',
            $diaSemana
        )

        ->first();

        if(!$disp){

            return response()->json([

                'ok'=>false,

                'msg'=>

                'El groomer no trabaja '

                .$diaSemana

            ]);

        }

        if(

            $inicio < $disp->hora_inicio

            ||

            $fin > $disp->hora_fin

        ){

            return response()->json([

                'ok'=>false,

                'msg'=>

                'Fuera del horario del groomer'

            ]);

        }

        // ==========================
        // SOLAPAMIENTO
        // ==========================

        $ocupado = Cita::where(

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

                'ok'=>false,

                'msg'=>

                'Horario ocupado'

            ]);

        }

        // ==========================
        // ACTUALIZAR CITA
        // ==========================

        $cita->fecha = $fecha;

        $cita->hora_inicio = $inicio;

        $cita->hora_fin = $fin;

        $cita->save();

        return response()->json([

            'ok'=>true

        ]);

    }


    public function cancelar($id)
    {
        $cita = Cita::findOrFail($id);

        $cita->estado =
            'cancelado';

        $cita->save();

        return redirect(
            '/agenda'
        )

        ->with(
            'success',
            'Cita cancelada'
        );
    }
    public function update(
    Request $request,
    $id
)
{
    $cita = Cita::findOrFail($id);

    // recalcular fin

    $inicio = strtotime(
        $request->hora_inicio
    );

    $fin = date(

        'H:i:s',

        $inicio +

        (

            $cita
            ->duracion_estimada_minutos

            *60

        )

    );

    // verificar choque

    $ocupado = Cita::where(

        'id_empleado',

        $cita->id_empleado

    )

    ->where(
        'fecha',
        $request->fecha
    )

    ->where(
        'id_cita',
        '!=',
        $id
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

        return back()

        ->with(

            'error',

            'Horario ocupado'

        );

    }

    $cita->fecha =
        $request->fecha;

    $cita->hora_inicio =
        $request->hora_inicio;

    $cita->hora_fin =
        $fin;

    if(
        $request->estado
    ){

        $cita->estado =
            $request->estado;

    }

    $cita->save();

    return redirect(
        '/agenda'
    )

    ->with(
        'success',
        'Cita actualizada'
    );
}
private function calcularFin($inicio, $duracion)
{
    return date('H:i:s', strtotime($inicio) + ($duracion * 60));
}
private function haySolapamiento($idEmpleado, $fecha, $inicio, $fin, $ignoreId = null)
{
    return Cita::where('id_empleado', $idEmpleado)
        ->where('fecha', $fecha)
        ->when($ignoreId, function ($q) use ($ignoreId) {
            $q->where('id_cita', '!=', $ignoreId);
        })
        ->where(function ($q) use ($inicio, $fin) {
            $q->whereBetween('hora_inicio', [$inicio, $fin])
              ->orWhereBetween('hora_fin', [$inicio, $fin]);
        })
        ->exists();
}
private function validarBloqueo($fecha)
{
    return DB::table('bloqueos_horario')
        ->where('fecha', $fecha)
        ->where('estado', 'activo')
        ->first();
}
private function obtenerDisponibilidad($idEmpleado, $dia)
{
    return DB::table('disponibilidad_empleado')
        ->where('id_empleado', $idEmpleado)
        ->whereRaw('LOWER(dia_semana)=?', [strtolower($dia)])
        ->first();
}
}