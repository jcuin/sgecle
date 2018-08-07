<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('asunto');
            $table->text('mensaje');
            $table->integer('id_idioma')->unsigned() -> nullable();
            $table->foreign('id_idioma')
                  ->references('id_idioma')
                  ->on('cat_idiomas')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->tinyInteger('atendido')->default(0);
            $table->string('enterado_a_traves_de')->nullable();
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
        Schema::dropIfExists('informes');
    }
}
