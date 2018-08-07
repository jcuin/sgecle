<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_grupos', function (Blueprint $table) {
            $table->integer('id_programa')->unsigned()->nullable();
            $table->foreign('id_programa')
                  ->references('id_programa')
                  ->on('cat_programas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_periodo')->unsigned()->nullable();
            $table->foreign('id_periodo')
                  ->references('id_periodo')
                  ->on('cat_periodos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->increments('id_grupo');
            $table->string('nombre');
            $table->string('observaciones')->nullable();
            $table->integer('id_idioma')->unsigned()->nullable();
            $table->foreign('id_idioma')
                  ->references('id_idioma')
                  ->on('cat_idiomas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_nivel')->unsigned()->nullable();
            $table->foreign('id_nivel')
                  ->references('id_nivel')
                  ->on('cat_nivelesmcer')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('capacidad')->default(18);
            $table->boolean('lunes')->default(false);
            $table->boolean('martes')->default(false);
            $table->boolean('miercoles')->default(false);
            $table->boolean('jueves')->default(false);
            $table->boolean('viernes')->default(false);
            $table->boolean('sabado')->default(false);
            $table->string('horario')->default('Pendiente de asignar');
            $table->string('salon')->default('Pendiente de asignar');
            $table->double('pago_semestral', 8, 2)->default(0.00);
            $table->integer('exhibiciones')->default(4);
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
        Schema::dropIfExists('cat_grupos');
    }
}
