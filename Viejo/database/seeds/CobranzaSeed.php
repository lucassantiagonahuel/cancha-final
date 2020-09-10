<?php

use Illuminate\Database\Seeder;
use App\Cobranza;

class CobranzaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cobranza::truncate();
    }
}
