<?php

namespace App\Http\Controllers;

use App\Models\BloqueoHorario;

use Illuminate\Http\Request;

class BloqueoController extends Controller
{
    public function index()
    {
        $bloqueos=
        BloqueoHorario::all();

        return view(

            'bloqueos.index',

            compact(
                'bloqueos'
            )

        );
    }

    public function create()
    {
        return view(
            'bloqueos.create'
        );
    }

    public function store(
        Request $request
    )
    {
        BloqueoHorario::create([

            'fecha'=>
            $request->fecha,

            'hora_inicio'=>
            $request->hora_inicio,

            'hora_fin'=>
            $request->hora_fin,

            'motivo'=>
            $request->motivo,

            'tipo'=>
            $request->tipo,

            'estado'=>
            'activo'

        ]);

        return redirect(
            '/bloqueos'
        );
    }
}