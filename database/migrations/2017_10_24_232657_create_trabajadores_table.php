<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->increments('id_trabajador');
            $table->string('foto')->default('default.jpg');
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno')->nullable();
            $table->string('curp')->unique();
            $table->string('rfc')->unique();
            $table->string('ife')->unique();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->char('sexo', 1);
            $table->date('fecha_nacimiento')->default('2000-01-01');
            $table->string('email')->default('NA');
            $table->string('estudios')->nullable();
            $table->string('titulo')->nullable();
            $table->string('cedula')->nullable();
            $table->date('fecha_ingreso');
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
        Schema::dropIfExists('trabajadores');
    }
}
