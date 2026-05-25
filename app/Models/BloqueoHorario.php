<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueoHorario extends Model
{
    protected $table =
        'bloqueos_horario';

    protected $primaryKey =
        'id_bloqueo';

    public $timestamps=false;

    protected $fillable=[

        'fecha',

        'hora_inicio',

        'hora_fin',

        'motivo',

        'tipo',

        'estado'

    ];
}