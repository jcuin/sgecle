<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnImagenPaginaOferta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagina_oferta', function (Blueprint $table) {
            //
            $table->string('oferta_imagen')->nullable()->after('id_pagina');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagina_oferta', function (Blueprint $table) {
            //
            $table->dropColumn('oferta_imagen');
        });
    }
}
