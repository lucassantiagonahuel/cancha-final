<?php
namespace App\Library;

use Illuminate\Http\Request;
use App\Usuario;

class SessionHelper
{
    public function actualiza_session_usuario(Request $request)
	{
        $request->session()->put("ingreso_backend",false);

        $usuario_obj = Usuario::find($request->session()->get("id"));

        if($usuario_obj)
        {
            $request->session()->put("nombre",$usuario_obj->nombre);
            $request->session()->put("apellido",$usuario_obj->apellido);
            $request->session()->put("correo",$usuario_obj->correo);

            $request->session()->put("ingreso_backend",true);
        }
        else
        {
            $this->destroy_session($request);
        }
	}

    public function destroy_session(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->flush();
    }
}

?>