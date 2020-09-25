<?php

use Illuminate\Database\Seeder;
use App\Caja;

class CajaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Caja::truncate();

        for($i=1; $i <= 5;$i++)
        {
            $caja_example = new Caja();
            $caja_example->descripcion = "TURNO #".$i;
            $caja_example->id_turno = $i;
            $caja_example->total = 160;
            $caja_example->fecha = "2020-09-23 10:00:00";
            $caja_example->save();
        }
    }
}
