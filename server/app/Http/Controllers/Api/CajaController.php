<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\ResponseEstructure;

use App\Caja;

class CobranzasController extends Controller
{
    
    public function index(Request $request)
    {
        $caja = Caja::all();
        return response()->json($caja);
    }

    public function store(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(true);

        $descripcion = ucfirst(trim($request->input("descripcion")));
        // $id_turno = strtolower(trim($request->input("id_turno")));
        // $total = strtolower(trim($request->input("total")));
        // $fecha = strtolower(trim($request->input("fecha")));

        if(strlen($descripcion) < 3)
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("La descripcion debe tener 3 caracteres como minimo");
        }


        if($response_estructure->get_response() == true)
        {
            $caja_new = new Caja();
            $caja_new->descripcion = $descripcion;
            $caja_new->id_turno = $id_turno;
            $caja_new->total = $total;
            $caja_new->fecha = $fecha;
            $caja_new->save();
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function edit(Request $request)
    {
        $respuesta = false;

        $id = $request->input("id");

        $caja_row = Caja::where("id",$id)->first();

        if($caja_row)
        {
            $descripcion = ucfirst(trim($request->input("descripcion")));
            $id_turno = strtolower(trim($request->input("id_turno")));
            $total = strtolower(trim($request->input("total")));
            $fecha = strtolower(trim($request->input("fecha")));

            $cliente_row->descripcion = $descripcion;
            $cliente_row->id_turno = $id_turno;
            $cliente_row->total = $total;
            $cliente_row->fecha = $fecha;
            $cliente_row->save();

            $respuesta = true;
        }

        return response()->json($respuesta);
    }

    public function get(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(true);

        $id = $request->input("id");

        $caja_row = Caja::where("id",$id)->first();

        if($caja_row)
        {
            $response_estructure->set_data($caja_row);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("La caja no existe");
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function delete(Request $request)
    {
        $respuesta = false;

        $id = $request->input("id");

        $caja_row = Caja::where("id",$id)->first();

        if($caja_row)
        {
            $caja_row->delete();
            $respuesta = true;
        }
        
        return response()->json($respuesta);
    }
}
