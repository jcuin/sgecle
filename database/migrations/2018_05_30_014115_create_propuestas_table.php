<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuestas', function (Blueprint $table) {
            $table->increments('id_propuesta');
            $table->integer('id_planeacion')->nullable()->unsigned();
            $table->foreign('id_planeacion')
                  ->references('id_planeacion')
                  ->on('planeaciones')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('archivo')->default('ninguno');
            $table->date('fecha_de_uso');
            $table->string('detalles');
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
        Schema::dropIfExists('propuestas');
    }
}
