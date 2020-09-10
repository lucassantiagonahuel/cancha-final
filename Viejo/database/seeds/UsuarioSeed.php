<?php

use Illuminate\Database\Seeder;
use App\Usuario;

class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::truncate();

        $usuario_obj = new Usuario();
        $usuario_obj->nombre = "Marcelo";
        $usuario_obj->apellido = "Tinelli";
        $usuario_obj->correo = "administrador@gmail.com";
        $usuario_obj->password = bcrypt("123456");
        $usuario_obj->save();
    }
}
