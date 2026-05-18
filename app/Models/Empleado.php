<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table='empleados';

    protected $primaryKey='id_empleado';

    public $timestamps=false;

    protected $fillable=[

        'id_usuario',

        'cargo',

        'fecha_ingreso',

        'turno'

    ];

    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario'
        );
    }

}