<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlumnoTrabajadorForeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_alumno')->unsigned()->nullable()->after('id_user');
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_trabajador')->unsigned()->nullable()->after('id_alumno');
            $table->foreign('id_trabajador')
                  ->references('id_trabajador')
                  ->on('trabajadores')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('photo')->default('default.jpg')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table -> dropColumn('id_alumno');
            $table -> dropColumn('id_trabajador');
            $table -> dropColumn('photo');
        });
    }
}
