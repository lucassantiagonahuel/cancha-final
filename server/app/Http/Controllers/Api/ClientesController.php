<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Library\ResponseEstructure;

use App\Cliente;

class ClientesController extends Controller
{
    public function index(Request $request)
    {   
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);
        
        //$busqueda = $request->input("busqueda");
        $clientes = Cliente::all();
        return response()->json($clientes);
        
        //$input = [
        //    "busqueda" => $busqueda
        //];
    }

    public function store(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(true);

        $nombre = ucfirst(trim($request->input("nombre")));
        $apellido = ucfirst(trim($request->input("apellido")));
        $telefono = strtolower(trim($request->input("telefono")));
        $domicilio = strtolower(trim($request->input("domicilio")));

        if(strlen($nombre) < 3)
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("El nombre debe tener 3 caracteres como minimo");
        }

        if(strlen($apellido) < 3)
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("El apellido debe tener 3 caracteres como minimo");
        }

        if(strlen($telefono) < 6)
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("El telefono debe tener 6 caracteres como minimo");
        }

        if(strlen($domicilio) < 6)
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("El domicilio debe tener 6 caracteres como minimo");
        }

        if($response_estructure->get_response() == true)
        {
            $cliente_new = new Cliente();
            $cliente_new->nombre = $nombre;
            $cliente_new->apellido = $apellido;
            $cliente_new->telefono = $telefono;
            $cliente_new->domicilio = $domicilio;
            $cliente_new->save();
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function edit(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $cliente_row = Cliente::where("id",$id)->first();

        if($cliente_row)
        {
            $nombre = ucfirst(trim($request->input("nombre")));
            $apellido = ucfirst(trim($request->input("apellido")));
            $telefono = strtolower(trim($request->input("telefono")));
            $domicilio = strtolower(trim($request->input("domicilio")));

            $cliente_row->nombre = $nombre;
            $cliente_row->apellido = $apellido;
            $cliente_row->telefono = $telefono;
            $cliente_row->domicilio = $domicilio;
            $cliente_row->save();

            $response_estructure->set_response(true);
            //$respuesta = true;
        }
        
        return response()->json($response_estructure->get_response_array());
        //return response()->json($respuesta);
    }

    public function get(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(true);

        $id = $request->input("id");

        $cliente_row = Cliente::where("id",$id)->first();

        if($cliente_row)
        {
            $response_estructure->set_data($cliente_row);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("El cliente no existe");
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function delete(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $cliente_row = Cliente::where("id",$id)->first();

        if($cliente_row)
        {
            $cliente_row->delete();
            $response_estructure->set_response(true);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("El cliente no existe");
        }

        return response()->json($response_estructure->get_response_array());
    }
}
