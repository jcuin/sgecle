<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('direccion');
            $table->string('subdireccion');
            $table->string('coordinacion_general');
            $table->string('coordinacion_academica');
            $table->string('coordinacion_administrativa');
            $table->string('iniciales');
            $table->string('numero_registro');
            $table->string('rfc');
            $table->string('razon_social');
            $table->string('domicilio');
            $table->string('telefono_contacto');
            $table->string('correo_electronico');
            $table->integer('id_periodo_interno')->nullable()->unsigned();
            $table->foreign('id_periodo_interno')
                  ->references('id_periodo')
                  ->on('cat_periodos')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->integer('id_periodo_externo')->nullable()->unsigned();
            $table->foreign('id_periodo_externo')
                  ->references('id_periodo')
                  ->on('cat_periodos')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
             $table->integer('id_periodo_tenaris')->nullable()->unsigned();
            $table->foreign('id_periodo_tenaris')
                  ->references('id_periodo')
                  ->on('cat_periodos')
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
        Schema::dropIfExists('settings');
    }
}
