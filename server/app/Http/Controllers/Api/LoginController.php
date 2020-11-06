<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\SessionHelper;

use App\Library\ResponseEstructure;
use Illuminate\Support\Facades\Validator;
use App\Library\ManagerJWT;
use Illuminate\Support\Facades\Hash;

use App\Usuario;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        $correo = trim($request->input("correo")); 
        $password = trim($request->input("password")); 

        $input= [
            "correo"=>$correo,
            "password"=>$password,
        ];

        $rules = [
            "correo"=>"required|email", 
            "password"=>"required",
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
            $usuario_obj = Usuario::where("correo",$correo)->first();

            if($usuario_obj)
            {
                if (Hash::check($password, $usuario_obj->password)) {

                    $ManagerJWT = new ManagerJWT();
                    $jwt = $ManagerJWT->loginUser($usuario_obj->id);
                    
                    $response_estructure->set_response(true);
                    $response_estructure->set_data($jwt);
                }
                else
                {
                    $response_estructure->set_response(false);
                    $response_estructure->add_message_error("Contraseña incorrecta");
                }
            }
            else
            {
                $response_estructure->set_response(false);
                $response_estructure->add_message_error("No se encontró el correo asociado a la cuenta");
            }
        }

        return response()->json($response_estructure->get_response_array());
    }

    public function cerrarSession(Request $request)
    {
        $ManagerJWT = new ManagerJWT();
        $respuesta = $ManagerJWT->logout($request->input("jwt_token"));

        return response()->json("OK!");
    }
}
