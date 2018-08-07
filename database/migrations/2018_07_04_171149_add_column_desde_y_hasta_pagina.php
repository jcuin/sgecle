<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDesdeYHastaPagina extends Migration
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
            $table->dateTime('desde')->nullable()->after('activo');
            $table->dateTime('hasta')->nullable()->after('desde');
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
            $table->dropColumn('desde');
            $table->dropColumn('hasta');
        });
    }
}
