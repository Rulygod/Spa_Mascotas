<?php

namespace App\Http\Controllers;


use App\Models\Cliente;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
class ClienteController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function cuenta()
    {

        $cliente=

        Cliente::where(

        'id_usuario',

        Auth::user()->id_usuario

        )->first();

        $mascotas=[];

        if($cliente){

            $mascotas=

            Mascota::where(

            'id_cliente',

            $cliente->id_cliente

            )->get();
        }
        $servicios = DB::table('servicios')
        ->where('estado', 'activo')
        ->get();
        $solicitudesPendientes = DB::table('solicitudes')
        ->join('mascotas', 'solicitudes.id_mascota', '=', 'mascotas.id_mascota')
        ->join('servicios', 'solicitudes.id_servicio', '=', 'servicios.id_servicio')
        ->where('solicitudes.id_cliente', $cliente->id_cliente)
        ->where('solicitudes.estado', 'pendiente')
        ->select(
            'solicitudes.*',
            'mascotas.nombre as nombre_mascota',
            'servicios.nombre as nombre_servicio'
        )
        ->get();


    $solicitudesProceso = DB::table('solicitudes')
        ->join('mascotas', 'solicitudes.id_mascota', '=', 'mascotas.id_mascota')
        ->join('servicios', 'solicitudes.id_servicio', '=', 'servicios.id_servicio')
        ->where('solicitudes.id_cliente', $cliente->id_cliente)
        ->where('solicitudes.estado', 'en_proceso')
        ->select(
            'solicitudes.*',
            'mascotas.nombre as nombre_mascota',
            'servicios.nombre as nombre_servicio'
        )
        ->get();


    $historial = DB::table('solicitudes')
        ->join('mascotas', 'solicitudes.id_mascota', '=', 'mascotas.id_mascota')
        ->join('servicios', 'solicitudes.id_servicio', '=', 'servicios.id_servicio')
        ->where('solicitudes.id_cliente', $cliente->id_cliente)
        ->where('solicitudes.estado', 'finalizado')
        ->select(
            'solicitudes.*',
            'mascotas.nombre as nombre_mascota',
            'servicios.nombre as nombre_servicio'
        )
        ->get();

        return view(

        'cliente.cuenta',

        compact(
            'cliente',
            'mascotas',
            'servicios',
            'solicitudesPendientes',
            'solicitudesProceso',
            'historial'
        )

        );

    }

}
