<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false; // 🔥 SOLUCIÓN
    
    protected $fillable = [
        'id_rol',
        'nombres',
        'apellidos',
        'correo',
        'contrasena',
        'telefono',
        'estado'
    ];

    protected $hidden = [
        'contrasena'
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}