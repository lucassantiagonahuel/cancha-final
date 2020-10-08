<?php

use Illuminate\Database\Seeder;
use App\Turno;

class TurnoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turno::truncate();

        for($i=13; $i <= 22;$i++)
        {
            $turno_example = new Turno();
            $turno_example->cliente_id = 1;
            $turno_example->precio = 160;
            $turno_example->fecha_hora_desde = "2020-09-23 ".$i.":00:00";
            $turno_example->fecha_hora_hasta = "2020-09-23 ".($i+1).":00:00";
            $turno_example->save();
        }
    }
}
