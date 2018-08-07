<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaginaHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina_horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pagina')-> unsigned() -> nullable();
            $table->foreign('id_pagina')
                  ->references('id')
                  ->on('pagina')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('horario_imagen')->nullable();
            $table->string('horario_titulo_imagen')->nullable();
            $table->string('horario_texto_imagen')->nullable();
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
        Schema::dropIfExists('pagina_horarios');
    }
}
