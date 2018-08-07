<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos', function (Blueprint $table) {
            $table->increments('id_anexo');
            $table->integer('id_planeacion')->nullable()->unsigned();
            $table->foreign('id_planeacion')
                  ->references('id_planeacion')
                  ->on('planeaciones')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('archivo');
            $table->smallInteger('numero_copias');
            $table->date('fecha_entrega');
            $table->date('fecha_de_uso');
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
        Schema::dropIfExists('anexos');
    }
}
