<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Mascota;
use Illuminate\Support\Facades\DB;
class SolicitudController extends Controller
{
    public function store(Request $request)
    {
        $cliente = DB::table('clientes')
        ->where('id_usuario', auth()->user()->id_usuario)
        ->first();
        // ⚠️ Validación básica (evita crash futuro)
        if (!$cliente) {
            return back()->with('error', 'No se encontró el cliente asociado al usuario.');
        }
        Solicitud::create([
            'id_cliente' => $cliente->id_cliente,
            'id_mascota' => $request->id_mascota,
            'id_servicio' => $request->id_servicio,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'nota' => $request->nota,
            'estado' => 'pendiente'
        ]);

        return back()->with('success', 'Solicitud enviada correctamente');
    }
}
