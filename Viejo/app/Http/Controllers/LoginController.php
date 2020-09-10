<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SessionHelper;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $correo =  $request->input("correo");

        if($correo != "")
        {
            $request->session()->put("id",1);

            $SessionHelper = new SessionHelper();
            $SessionHelper->actualiza_session_usuario($request);

            return Redirect("/clientes");
        }
        
        return view('login');
    }
}
