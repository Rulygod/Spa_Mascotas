<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogHelper
{
    public static function registrar($accion)
    {
        $usuario = Auth::user();

        DB::table('logs')->insert([
            'user_id' => $usuario ? $usuario->id_usuario : null,
            'rol' => $usuario ? $usuario->id_rol : 'invitado',
            'accion' => $accion,
            'ip' => request()->ip(),
            'navegador' => request()->header('User-Agent'),
            'fecha' => now()
        ]);
    }
}