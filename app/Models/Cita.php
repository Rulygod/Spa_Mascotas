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

}