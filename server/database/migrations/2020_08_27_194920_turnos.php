<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Turnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("cliente_id")->unsigned()->nullable();
            $table->foreign("cliente_id")->references("id")->on("clientes");
            $table->double("precio");
            $table->datetime("fecha_hora_desde");
            $table->datetime("fecha_hora_hasta");
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
        Schema::dropIfExists('turnos');
    }
}
