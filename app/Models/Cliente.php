<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    protected $fillable = [

        'id_usuario',

        'direccion'

    ];

   public function usuario()
    {
        return $this->belongsTo(usuario::class, 'id_usuario', 'id_usuario');
    }

    public function mascotas()
    {
        return $this->hasMany(
            Mascota::class,
            'id_cliente'
        );
    }
}