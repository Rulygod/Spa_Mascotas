<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();

        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        Servicio::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'duracion_minutos' => $request->duracion,
            'precio' => $request->precio,
            'tipo_mascota' => $request->tipo_mascota,
            'estado' => 'activo'
        ]);

        return redirect('/servicios');
    }
}