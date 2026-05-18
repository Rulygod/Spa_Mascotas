<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisponibilidadEmpleado extends Model
{
    protected $table=
    'disponibilidad_empleado';

    protected $primaryKey=
    'id_disponibilidad';

    public $timestamps=false;

    protected $fillable=[

        'id_empleado',

        'dia_semana',

        'hora_inicio',

        'hora_fin',

        'estado'

    ];

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class,
            'id_empleado'
        );
    }

}