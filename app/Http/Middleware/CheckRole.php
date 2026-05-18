<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $rol)
    {
        if (!Auth::check()) {
            dd('NO ESTA LOGUEADO');
        }

        if (Auth::user()->id_rol != $rol) {
            abort(403, 'No autorizado');
        }
        return $next($request);
    }
}