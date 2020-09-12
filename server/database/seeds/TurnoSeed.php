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
    }
}
