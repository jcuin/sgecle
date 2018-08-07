<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id_alumno');
            $table->string('foto')->default('default.jpg');
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno')->nullable();
            $table->string('curp')->nullable();  
            $table->string('padre_o_tutor')->unique();      
            $table->string('telefono')->nullable();
            $table->char('sexo', 1);
            $table->date('fecha_nacimiento')->default('2000-01-01');
            $table->string('email')->default('NA');
            $table->string('padecimientos')->nullable();
            $table->boolean('trabajador')->default(false);
            $table->boolean('hijo_trabajador')->default(false);
            $table->string('no_control')->default('NA');
            $table->integer('id_carrera')->unsigned()->nullable();
            $table->foreign('id_carrera')
                  ->references('id_carrera')
                  ->on('cat_carreras')
                  ->onDelete('set null')
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
        Schema::dropIfExists('alumnos');
    }
}
