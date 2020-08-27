<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call(UsuarioSeed::class);
        $this->call(ClienteSeed::class);
        $this->call(CobranzaSeed::class);
        $this->call(TurnoSeed::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
