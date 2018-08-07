<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaginaTalleresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina_talleres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pagina')-> unsigned() -> nullable();
            $table->foreign('id_pagina')
                  ->references('id')
                  ->on('pagina')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('talleres_imagen') -> nullable();
            $table->string('talleres_titulo') -> nullable();
            $table->string('talleres_texto') -> nullable();
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
        Schema::dropIfExists('pagina_talleres');
    }
}
