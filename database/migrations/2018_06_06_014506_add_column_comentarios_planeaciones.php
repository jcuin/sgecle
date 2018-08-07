<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnComentariosPlaneaciones extends Migration
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
            $table->string('comentarios')->nullable()->after('archivo');
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
            $table->dropColumn('comentarios');
        });
    }
}
