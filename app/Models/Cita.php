<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table='citas';

    protected $primaryKey='id_cita';

    public $timestamps=false;

    protected $fillable=[

        'id_mascota',

        'id_servicio',

        'id_empleado',

        'fecha',

        'hora_inicio',

        'hora_fin',

        'duracion_estimada_minutos',

        'estado'

    ];

    // 🔥 RELACIÓN MASCOTA
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota');
    }

    // 🔥 RELACIÓN SERVICIO
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    // 🔥 RELACIÓN EMPLEADO
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

}