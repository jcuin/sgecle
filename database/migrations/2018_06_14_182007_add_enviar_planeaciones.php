<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnviarPlaneaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planeaciones', function (Blueprint $table) {
            //
            $table->tinyInteger('enviar')->nullable()->after('comentarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planeaciones', function (Blueprint $table) {
            //
            $table -> dropColumn('enviar');
        });
    }
}
