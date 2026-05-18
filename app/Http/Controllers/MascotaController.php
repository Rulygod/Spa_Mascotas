<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MascotaController extends Controller
{

    public function store(Request $request)
    {

        $cliente=Cliente::where(

            'id_usuario',

            Auth::user()->id_usuario

        )->first();

        $foto=null;

        if($request->hasFile('foto')){

            $foto=$request
            ->file('foto')
            ->store(
                'mascotas',
                'public'
            );
        }

        Mascota::create([

            'id_cliente'=>$cliente->id_cliente,

            'nombre'=>$request->nombre,

            'especie'=>$request->especie,

            'raza'=>$request->raza,

            'sexo'=>$request->sexo,

            'fecha_nacimiento'=>$request->fecha_nacimiento,

            'peso'=>$request->peso,

            'color'=>$request->color,

            'temperamento_general'=>$request->temperamento,

            'alergias'=>$request->alergias,

            'cuidados_especiales'=>$request->cuidados,

            'observaciones'=>$request->observaciones,

            'foto'=>$foto,

            'estado'=>'activa'

        ]);

        return back();
    }

    public function update(
        Request $request,
        $id
    ){

        $m=Mascota::findOrFail($id);

        if($request->hasFile('foto')){

            $m->foto=

            $request
            ->file('foto')

            ->store(
                'mascotas',
                'public'
            );
        }

        $m->nombre=$request->nombre;
        $m->especie=$request->especie;
        $m->raza=$request->raza;
        $m->sexo=$request->sexo;
        $m->fecha_nacimiento=$request->fecha_nacimiento;
        $m->peso=$request->peso;
        $m->color=$request->color;

        $m->temperamento_general=
        $request->temperamento;

        $m->alergias=
        $request->alergias;

        $m->cuidados_especiales=
        $request->cuidados;

        $m->observaciones=
        $request->observaciones;

        $m->save();

        return back();

    }

    public function destroy($id)
    {

        Mascota::findOrFail($id)
        ->delete();

        return back();

    }

}