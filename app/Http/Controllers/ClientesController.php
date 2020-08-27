<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $correo = $request->input("correo");

        if($correo != "")
        {
            
        }

        return view('clientes');
    }
}
