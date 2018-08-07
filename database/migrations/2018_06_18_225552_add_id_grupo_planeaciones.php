<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdGrupoPlaneaciones extends Migration
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
            $table->integer('id_grupo')->unsigned() -> nullable() -> before('id_planeacion');
            $table->foreign('id_grupo')
                  ->references('id_grupo')
                  ->on('cat_grupos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('semana')->nullable()->after('id_grupo');
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
            $table -> dropForeign('id_grupo');
            $table -> dropColumn('id_grupo');
            $table -> dropColumn('semana');
        });
    }
}
