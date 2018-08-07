<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->increments('id_inscripcion');
            $table->integer('id_grupo')->nullable()->unsigned();
            $table->foreign('id_grupo')
                  ->references('id_grupo')
                  ->on('cat_grupos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_alumno')->nullable()->unsigned();
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->smallInteger('escrito')->nullable()->default(0);
            $table->smallInteger('oral')->nullable()->default(0);
            $table->smallInteger('escrito2')->nullable()->default(0);
            $table->smallInteger('oral2')->nullable()->default(0);
            $table->smallInteger('escrito3')->nullable()->default(0);
            $table->smallInteger('oral3')->nullable()->default(0);
            $table->smallInteger('infoskillsd')->nullable()->default(0);
            $table->smallInteger('pedagogy')->nullable()->default(0);
            $table->smallInteger('linguistics')->nullable()->default(0);
            $table->smallInteger('phonology')->nullable()->default(0);
            $table->smallInteger('profderiv')->nullable()->default(0);
            $table->smallInteger('elt')->nullable()->default(0);
            $table->smallInteger('classobjectives')->nullable()->default(0);
            $table->smallInteger('classcontrol')->nullable()->default(0);
            $table->smallInteger('evaluation')->nullable()->default(0);
            $table->smallInteger('tutoring')->nullable()->default(0);
            $table->smallInteger('observation')->nullable()->default(0);
            $table->boolean('evaluacion_docente')->nullable()->default(0);
            $table->boolean('reconocimiento')->nullable()->default(0);
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
        Schema::dropIfExists('inscripciones');
    }
}
