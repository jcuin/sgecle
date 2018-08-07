<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaginaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_principal_imagen')->default('sicoferli.jpg');
            $table->string('banner_principal_texto');
            $table->string('instalaciones_titulo')->nullable();
            $table->string('instalaciones_texto')->nullable();
            $table->string('horario_titulo')->nullable();
            $table->string('horario_texto')->nullable();
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
        Schema::dropIfExists('pagina');
    }
}
