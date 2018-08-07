<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTallerTituloPagina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagina', function (Blueprint $table) {
            //
            $table->string('taller_encabezado')->nullable()->after('horario_texto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagina', function (Blueprint $table) {
            //
            $table->dropColumn('taller_encabezado');
        });
    }
}
