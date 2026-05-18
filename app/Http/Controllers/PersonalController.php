<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PersonalController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        return view('empleado.dashboard', compact('usuario'));
    }
}
