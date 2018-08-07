<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id_agenda');
            $table->integer('id_periodo')-> unsigned() -> nullable();
            $table->foreign('id_periodo')
                  ->references('id_periodo')
                  ->on('cat_periodos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  
            $table->string('evento')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha_evento')->nullable();
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
        Schema::dropIfExists('agenda');
    }
}
