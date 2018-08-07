<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnHoraInicioHoraFinAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agenda', function (Blueprint $table) {
            //
            $table->time('hora_inicio')->nullable()->after('fecha_evento');
            $table->time('hora_fin')->nullable()->after('hora_inicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agenda', function (Blueprint $table) {
            //
            $table->dropColumn('hora_inicio');
            $table->dropColumn('hora_fin');
        });
    }
}
