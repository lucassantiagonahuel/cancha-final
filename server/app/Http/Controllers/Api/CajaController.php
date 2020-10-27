<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use App\Caja;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $fechaDesde = $request->input("fechaDesde");
        $fechaHasta = $request->input("fechaHasta");

        $input= [
            "fecha_desde"=>$fechaDesde,
            "fecha_hasta"=>$fechaHasta,
        ];

        $rules = [
            "fecha_desde"=>"required|required|date_format:d/m/Y",
            "fecha_hasta"=>"required|required|date_format:d/m/Y",
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $response_estructure->set_response(false);

            $errors = $validator->errors();

            foreach ($errors->all() as $error) {
                $response_estructure->add_message_error($error);
            }
        }

        else {
            $fechaDesde = \DateTime::createFromFormat("d/m/Y",$fechaDesde);
            $fechaHasta = \DateTime::createFromFormat("d/m/Y",$fechaHasta);

            $caja = DB::table("caja")
            ->select(
                    "caja.*",
                     DB::raw("DATE_FORMAT(caja.fecha,'%d/%m/%Y %H:%i') as fecha_caja"),
                     DB::raw("DATE_FORMAT(caja.created_at,'%d/%m/%Y %H:%i') as fecha_creacion_esp")
                    )
            ->where(DB::raw("DATE_FORMAT(caja.created_at,'%Y/%m/%Y')"),">=",$fechaDesde->format("Y/m/d"))
            ->where(DB::raw("DATE_FORMAT(caja.created_at,'%Y/%m/%Y')"),"<=",$fechaHasta->format("Y/m/d"))        
            ->orderBy("caja.id","desc")
            ->get();

            $response_estructure->set_data($caja);
            $response_estructure->set_response(true);
        }


        

        return response()->json($response_estructure->get_response_array());
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
            $descripcion = strtolower(trim($request->input("descripcion")));
            $total = strtolower(trim($request->input("total")));
            $fecha = strtolower(trim($request->input("fecha")));

            $fecha = \DateTime::createFromFormat("d/m/Y H:i",$fecha);
            $fecha = $fecha->format("Y-m-d H:i:s");

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
            DB::raw("DATE_FORMAT(caja.fecha,'%d/%m/%Y %H:%i') as fecha"),
            DB::raw("DATE_FORMAT(caja.created_at,'%d/%m/%Y %H:%i') as fecha_creacion_esp")
        )
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
