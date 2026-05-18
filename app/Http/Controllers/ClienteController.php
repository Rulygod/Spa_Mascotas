<?php

namespace App\Http\Controllers;


use App\Models\Cliente;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ClienteController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function cuenta()
    {

        $cliente=

        Cliente::where(

        'id_usuario',

        Auth::user()->id_usuario

        )->first();

        $mascotas=[];

        if($cliente){

            $mascotas=

            Mascota::where(

            'id_cliente',

            $cliente->id_cliente

            )->get();
        }

        return view(

        'cliente.cuenta',

        compact(
            'mascotas'
        )

        );

    }

}
