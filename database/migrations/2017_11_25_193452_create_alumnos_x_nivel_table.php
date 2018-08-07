<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosXNivelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_x_nivel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_alumno')->unsigned();
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_idioma')->unsigned();
            $table->foreign('id_idioma')
                  ->references('id_idioma')
                  ->on('cat_idiomas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_nivel')->unsigned();
            $table->foreign('id_nivel')
                  ->references('id_nivel')
                  ->on('cat_nivelesmcer')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::dropIfExists('alumnos_x_nivel');
    }
}
