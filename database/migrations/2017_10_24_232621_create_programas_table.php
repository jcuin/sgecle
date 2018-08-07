<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_programas', function (Blueprint $table) {
            $table->increments('id_programa');
            $table->string('programa');
            $table->double('costo_publico', 8,2)->nullable()->default(0);
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
        Schema::dropIfExists('cat_programas');
    }
}
