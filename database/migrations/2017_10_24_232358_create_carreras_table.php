<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_carreras', function (Blueprint $table) {
            $table->increments('id_carrera');
            $table->string('nombre_carrera');
            $table->string('nombre_reducido');
            $table->string('reticula');
            $table->string('siglas');
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
        Schema::dropIfExists('cat_carreras');
    }
}
