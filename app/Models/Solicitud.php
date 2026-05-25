<?php

namespace App\Models;
use App\Models\Mascota;
use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $primaryKey = 'id_solicitud';

    protected $fillable = [
        'id_cliente',
        'id_mascota',
        'id_servicio',
        'fecha',
        'hora_inicio',
        'nota',
        'estado'
    ];

     // 👇 RELACIÓN CON MASCOTA
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota', 'id_mascota');
    }

    // 👇 RELACIÓN CON CLIENTE
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // 👇 RELACIÓN CON SERVICIO (TE VA A SERVIR DESPUÉS)
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id_servicio');
    }
}
