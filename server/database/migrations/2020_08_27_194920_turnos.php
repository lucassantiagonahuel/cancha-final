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
            $table->foreign("cliente_id")->references("id")->on("clientes")->onDelete("set null");
            $table->double("precio");
            $table->datetime("fecha_hora_desde");
            $table->datetime("fecha_hora_hasta");
            $table->enum("estado",["pendiente","realizado","cancelado"])->default("pendiente");
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
