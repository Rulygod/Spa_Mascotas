<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisponibilidadEmpleado;
use App\Models\Empleado;
use App\Models\Usuario;

class DisponibilidadController extends Controller
{
    public function index()
    {
        $datos=

        DisponibilidadEmpleado::join(

        'empleados',

        'disponibilidad_empleado.id_empleado',

        '=',

        'empleados.id_empleado'

        )

        ->join(

        'usuarios',

        'empleados.id_usuario',

        '=',

        'usuarios.id_usuario'

        )

        ->select(

        'disponibilidad_empleado.*',

        'usuarios.nombres',

        'usuarios.apellidos'

        )

        ->get();

        return view(

        'disponibilidad.index',

        compact('datos')

        );
    }

    public function store(Request $r)
    {
        DisponibilidadEmpleado::create([
            'id_empleado'=>$r->id_empleado,
            'dia_semana'=>$r->dia,
            'hora_inicio'=>$r->inicio,
            'hora_fin'=>$r->fin,
            'estado'=>'disponible'
        ]);

        return back();
    }
    public function create()
    {
        $groomers = Empleado::join(
            'usuarios',
            'empleados.id_usuario',
            '=',
            'usuarios.id_usuario'
        )

        ->whereRaw(
            "LOWER(empleados.cargo)='groomer'"
        )

        ->select(
            'empleados.*',
            'usuarios.nombres',
            'usuarios.apellidos'
        )

        ->get();

        return view(
            'disponibilidad.create',
            compact('groomers')
        );
    }

    public function edit($id)
    {
        $disp=
        DisponibilidadEmpleado::findOrFail($id);

        $groomers=
        Empleado::where(
            'cargo',
            'groomer'
        )->get();

        return view(
            'disponibilidad.edit',
            compact(
                'disp',
                'groomers'
            )
        );
    }

    public function update(
    Request $r,
    $id
    ){

    $disp=
    DisponibilidadEmpleado
    ::findOrFail($id);

    $disp->update([

    'id_empleado'=>$r->id_empleado,

    'dia_semana'=>$r->dia,

    'hora_inicio'=>$r->inicio,

    'hora_fin'=>$r->fin,

    'estado'=>$r->estado

    ]);

    return redirect(
    '/disponibilidad'
    );

    }

    public function destroy($id)
    {
    DisponibilidadEmpleado
    ::destroy($id);

    return back();
    }
}