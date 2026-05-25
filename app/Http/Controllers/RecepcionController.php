<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cita;
use App\Models\Solicitud;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class RecepcionController extends Controller
{
    /**
     * DASHBOARD PRINCIPAL DE RECEPCIÓN
     */
    public function index()
{
    $usuario = Auth::user();

    $citasHoy = Cita::whereDate('fecha', now())->count();

    $solicitudesPendientes = Solicitud::where('estado', 'pendiente')->count();

    $solicitudesRecientes = Solicitud::with([
            'cliente',
            'mascota',
            'servicio'
        ])
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    $citasProceso = Cita::where('estado', 'reservado')->count();

    return view('recepcion.dashboard', compact(
        'usuario',
        'citasHoy',
        'solicitudesPendientes',
        'citasProceso',
        'solicitudesRecientes',
    ));
}

    /**
     * LISTA DE SOLICITUDES (PANTALLA APARTE SI QUIERES)
     */
    public function solicitudes()
    {
        $solicitudes = Solicitud::with([
                'cliente',
                'mascota',
                'servicio'
            ])
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('recepcion.solicitudes', compact('solicitudes'));
    }

    /**
     * MARCAR SOLICITUD COMO EN PROCESO (opcional)
     */
    public function tomarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $solicitud->estado = 'en_proceso';
        $solicitud->save();

        return redirect()->back()
            ->with('success', 'Solicitud tomada por recepción');
    }

    /**
     * CONVERTIR SOLICITUD EN CITA (atajo de recepción)
     */
    public function convertirSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        return redirect('/agenda/create?solicitud=' . $solicitud->id_solicitud);
    }

    /**
     * MARCAR COMO PAGADO (cobranza básica)
     */
    public function registrarPago($id)
    {
        $cita = Cita::findOrFail($id);

        $cita->estado = 'pagado';
        $cita->save();

        return redirect()->back()
            ->with('success', 'Pago registrado correctamente');
    }

    /**
     * CANCELAR CITA (desde recepción)
     */
    public function cancelarCita($id)
    {
        $cita = Cita::findOrFail($id);

        $cita->estado = 'cancelado';
        $cita->save();

        return redirect()->back()
            ->with('success', 'Cita cancelada');
    }
    public function agenda()
    {
        $citas = Cita::with(['mascota', 'servicio'])
            ->orderBy('fecha')
            ->get();

        return view('agenda.index', compact('citas'));
    }
}