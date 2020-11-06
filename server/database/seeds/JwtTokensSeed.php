<?php

use Illuminate\Database\Seeder;
use App\JwtTokens;

class JwtTokensSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JwtTokens::truncate();
    }
}
