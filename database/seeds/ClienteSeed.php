<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class ClienteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::truncate();
        
        for($i=1; $i <= 100;$i++)
        {
            $cliente = new Cliente();
            $cliente->nombre = "Nombre".$i;
            $cliente->apellido = "Apellido".$i;
            $cliente->telefono = "+54344650403".$i;
            $cliente->domicilio = "Rocamora 1".$i;
            $cliente->save();
        }
    }
}
