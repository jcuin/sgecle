<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnActivoPagina extends Migration
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
            $table->tinyInteger('activo')->default('0')->after('taller_encabezado');
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
            $table->dropColumn('activo');
        });
    }
}
