<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaginaOfertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina_oferta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pagina')-> unsigned() -> nullable();
            $table->foreign('id_pagina')
                  ->references('id')
                  ->on('pagina')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('oferta_titulo')->nullable();
            $table->string('oferta_texto')->nullable();
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
        Schema::dropIfExists('pagina_oferta');
    }
}
