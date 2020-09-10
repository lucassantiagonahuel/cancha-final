<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnosController extends Controller
{
    public function index(Request $request)
    {
        return view('turnos');
    }
}
