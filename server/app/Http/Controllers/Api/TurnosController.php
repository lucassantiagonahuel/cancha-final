<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\BaseApiController;
use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;

use App\Turno;

class TurnosController extends BaseApiController
{
    public function index(Request $request)
    {
        $response_estructure = $this->validateToken($request->input("jwt_token"));

        if($response_estructure->get_login() == true)
        {
            $response_estructure->set_response(false);

            $fechaDesde = $request->input("fechaDesde");
            $fechaHasta = $request->input("fechaHasta");

            $input= [
                "fecha_desde"=>$fechaDesde,
                "fecha_hasta"=>$fechaHasta,
            ];

            $rules = [
                //"fecha_desde"=>"required|required|date_format:d/m/Y",
                //"fecha_hasta"=>"required|required|date_format:d/m/Y",
            ];

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                $response_estructure->set_response(false);

                $errors = $validator->errors();

                foreach ($errors->all() as $error) {
                    $response_estructure->add_message_error($error);
                }
            }
            else
            {
                if(trim($fechaDesde) != "" && trim($fechaHasta) != "")
                {
                    //$fechaDesde = \DateTime::createFromFormat("d/m/Y",$fechaDesde);
                    //$fechaHasta = \DateTime::createFromFormat("d/m/Y",$fechaHasta);
                }

                $turnos = DB::table("turnos")
                ->select(
                    "turnos.*",
                    "clientes.nombre as clientes_nombre",
                    "clientes.apellido as clientes_apellido",
                    DB::raw("DATE_FORMAT(turnos.fecha_hora_desde,'%d/%m/%Y %H:%i') as fecha_desde_esp"),
                    DB::raw("DATE_FORMAT(turnos.fecha_hora_hasta,'%d/%m/%Y %H:%i') as fecha_hasta_esp"),
                    DB::raw("DATE_FORMAT(turnos.created_at,'%d/%m/%Y %H:%i') as fecha_creacion_esp")
                )
                ->leftJoin("clientes","clientes.id","=","turnos.cliente_id");

                if(trim($fechaDesde) != "" && trim($fechaHasta) != "")
                {
                    $turnos = $turnos->where(DB::raw("DATE_FORMAT(turnos.fecha_hora_desde,'%Y-%m-%d')"),">=",$fechaDesde)
                    ->where(DB::raw("DATE_FORMAT(turnos.fecha_hora_desde,'%Y-%m-%d')"),"<=",$fechaHasta);
                }
                
                $turnos = $turnos->orderBy("turnos.id","desc")
                ->get();

                $response_estructure->set_data($turnos);
                $response_estructure->set_response(true);
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function store(Request $request)
    {
        $response_estructure = $this->validateToken($request->input("jwt_token"));

        if($response_estructure->get_login() == true)
        {
            $response_estructure->set_response(false);

            $cliente_id = strtolower(trim($request->input("cliente_id")));
            $precio = strtolower(trim($request->input("precio")));
            $fecha_hora_desde = strtolower(trim($request->input("fecha_hora_desde")));
            $fecha_hora_hasta = strtolower(trim($request->input("fecha_hora_hasta")));

            $fecha_hora_desde = \DateTime::createFromFormat("d/m/Y H:i",$fecha_hora_desde);
            $fecha_hora_desde = $fecha_hora_desde->format("Y-m-d H:i:s");

            $fecha_hora_hasta = \DateTime::createFromFormat("d/m/Y H:i",$fecha_hora_hasta);
            $fecha_hora_hasta = $fecha_hora_hasta->format("Y-m-d H:i:s");

            $response_estructure->set_response(true);

            if($response_estructure->get_response() == true)
            {
                $turno_row = new Turno();
                $turno_row->cliente_id = $cliente_id ;
                $turno_row->precio = $precio;
                $turno_row->fecha_hora_desde = $fecha_hora_desde;
                $turno_row->fecha_hora_hasta = $fecha_hora_hasta;
                $turno_row->save();

                $response_estructure->set_response(true);
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function edit(Request $request)
    {
        $response_estructure = $this->validateToken($request->input("jwt_token"));

        if($response_estructure->get_login() == true)
        {
            $response_estructure->set_response(false);

            $id = $request->input("id");

            $turno_row = Turno::where("id",$id)->first();

            if($turno_row)
            {
                $cliente_id = strtolower(trim($request->input("cliente_id")));
                $precio = strtolower(trim($request->input("precio")));
                $fecha_hora_desde = strtolower(trim($request->input("fecha_hora_desde")));
                $fecha_hora_hasta = strtolower(trim($request->input("fecha_hora_hasta")));

                $fecha_hora_desde = \DateTime::createFromFormat("d/m/Y H:i",$fecha_hora_desde);
                $fecha_hora_desde = $fecha_hora_desde->format("Y-m-d H:i:s");

                $fecha_hora_hasta = \DateTime::createFromFormat("d/m/Y H:i",$fecha_hora_hasta);
                $fecha_hora_hasta = $fecha_hora_hasta->format("Y-m-d H:i:s");

                $turno_row->cliente_id = $cliente_id ;
                $turno_row->precio = $precio;
                $turno_row->fecha_hora_desde = $fecha_hora_desde;
                $turno_row->fecha_hora_hasta = $fecha_hora_hasta;
                $turno_row->save();

                $response_estructure->set_response(true);
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function get(Request $request)
    {
        $response_estructure = $this->validateToken($request->input("jwt_token"));

        if($response_estructure->get_login() == true)
        {
            $response_estructure->set_response(true);

            $id = $request->input("id");

            $turno_row = $turnos = DB::table("turnos")
            ->select(
                "turnos.*",
                "clientes.nombre as clientes_nombre",
                "clientes.apellido as clientes_apellido",
                DB::raw("DATE_FORMAT(turnos.fecha_hora_desde,'%d/%m/%Y %H:%i') as fecha_desde_esp"),
                DB::raw("DATE_FORMAT(turnos.fecha_hora_hasta,'%d/%m/%Y %H:%i') as fecha_hasta_esp"),
                DB::raw("DATE_FORMAT(turnos.created_at,'%d/%m/%Y %H:%i') as fecha_creacion_esp")
            )
            ->leftJoin("clientes","clientes.id","=","turnos.cliente_id")
            ->where("turnos.id",$id)
            ->get();

            if($turno_row)
            {
                $turno_row = $turno_row[0];
                $response_estructure->set_data($turno_row);
            }
            else
            {
                $response_estructure->set_response(false);
                $response_estructure->add_message_error("El turno no existe");
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function delete(Request $request)
    {
        $response_estructure = $this->validateToken($request->input("jwt_token"));

        if($response_estructure->get_login() == true)
        {
            $response_estructure->set_response(false);

            $id = $request->input("id");

            $turno_row = Turno::where("id",$id)->first();

            if($turno_row)
            {
                $turno_row->delete();
                $response_estructure->set_response(true);
            }
            else
            {
                $response_estructure->set_response(false);
                $response_estructure->add_message_error("El turno no existe");
            }
        }

        return response()->json($response_estructure->get_response_array());
    }
}
