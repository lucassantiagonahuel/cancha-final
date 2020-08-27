<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobranzasController extends Controller
{
    public function index(Request $request)
    {
        return view('cobranzas');
    }
}
