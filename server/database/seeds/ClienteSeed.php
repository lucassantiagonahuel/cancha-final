<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
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
        $faker = Faker::create('es_ES');
        Cliente::truncate();
        
        for($i=1; $i <= 100;$i++)
        {
            $cliente = new Cliente();
            $cliente->nombre = $faker->firstNameMale;
            $cliente->apellido = $faker->lastName;
            $cliente->telefono = $faker->numerify('03446 - ### ###' );
            $cliente->domicilio = $faker->address;
            $cliente->save();
        }
    }
}
