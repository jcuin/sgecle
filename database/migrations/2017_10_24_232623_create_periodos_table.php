<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_periodos', function (Blueprint $table) {
            $table->integer('id_programa')->unsigned()->nullable();
            $table->foreign('id_programa')
                  ->references('id_programa')
                  ->on('cat_programas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->increments('id_periodo');
            $table->string('periodo');
            $table->date('fecha_inicio_curso');
            $table->date('fecha_fin_curso');
            $table->dateTime('fecha_limite_calificaciones');
            $table->dateTime('fecha_limite_evaluacion');
            $table->dateTime('fecha_limite_reconocimientos');
            $table->date('fecha_limite_pago');
            $table->tinyInteger('constante_referencia_pago')->default(4);
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
        Schema::dropIfExists('cat_periodos');
    }
}
