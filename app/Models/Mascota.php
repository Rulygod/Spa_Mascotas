<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'mascotas';

    protected $primaryKey = 'id_mascota';

    public $timestamps = false;

    protected $fillable = [

        'id_cliente',

        'nombre',

        'especie',

        'raza',

        'sexo',

        'fecha_nacimiento',

        'peso',

        'color',

        'temperamento_general',

        'alergias',

        'cuidados_especiales',

        'observaciones',

        'foto',

        'estado'

    ];

    public function cliente()
    {
        return $this->belongsTo(
            Cliente::class,
            'id_cliente'
        );
    }
}