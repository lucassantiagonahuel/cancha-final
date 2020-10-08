<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Library\ResponseEstructure;

use App\Caja;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        $caja = DB::table("caja")
        ->select(
            "caja.*",
            DB::raw("DATE_FORMAT(caja.fecha,'%d/%m/%Y %H:%i') as fecha_caja")
        )
        ->orderBy("caja.id","desc")
        ->get();

        return response()->json($caja);
    }

    public function store(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $descripcion = strtolower(trim($request->input("descripcion")));
        $total = strtolower(trim($request->input("total")));
        $fecha = strtolower(trim($request->input("fecha")));

        $fecha = \DateTime::createFromFormat("d/m/Y H:i",$fecha);
        $fecha = $fecha->format("Y-m-d H:i:s");

        $response_estructure->set_response(true);

        if($response_estructure->get_response() == true)
        {
            $caja_row = new Caja();
            $caja_row->descripcion = $descripcion;
            $caja_row->total = $total;
            $caja_row->fecha = $fecha;
            $caja_row->save();

            $response_estructure->set_response(true);
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function edit(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $caja_row = Caja::where("id",$id)->first();

        if($caja_row)
        {
            $caja_id = strtolower(trim($request->input("caja_id")));
            $descripcion = strtolower(trim($request->input("descripcion")));
            $total = strtolower(trim($request->input("total")));
            $fecha = strtolower(trim($request->input("fecha")));

            $fecha = \DateTime::createFromFormat("d/m/Y H:i",$fecha);
            $fecha = $fecha->format("Y-m-d H:i:s");

            $caja_row->caja_id = $caja_id ;
            $caja_row->descripcion = $descripcion;
            $caja_row->total= $total;
            $caja_row->fecha= $fecha;
            $caja_row->save();

            $response_estructure->set_response(true);
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function get(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(true);

        $id = $request->input("id");

        $caja_row = $caja = DB::table("caja")
        ->select(
            "caja.*",
            "caja.descripcion as caja_descripcion",
            "caja.total as caja_total",
            DB::raw("DATE_FORMAT(caja.fecha,'%d/%m/%Y %H:%i') as fecha")
        )
        ->leftJoin("caja","caja.id","=","caja.cliente_id")
        ->where("caja.id",$id)
        ->get();

        if($caja_row)
        {
            $caja_row = $caja_row[0];
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
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $id = $request->input("id");

        $caja_row = Caja::where("id",$id)->first();

        if($caja_row)
        {
            $caja_row->delete();
            $response_estructure->set_response(true);
        }
        else
        {
            $response_estructure->set_response(false);
            $response_estructure->add_message_error("La caja no existe");
        }

        return response()->json($response_estructure->get_response_array());
    }
}
