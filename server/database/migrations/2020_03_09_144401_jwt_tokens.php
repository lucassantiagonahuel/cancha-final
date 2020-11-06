<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JwtTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jwt_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string("iss");
            $table->string("sub");
            $table->datetime("iat");
            $table->datetime("nbf");
            $table->datetime("exp");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('jwt_tokens');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
