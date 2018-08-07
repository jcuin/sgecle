<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->increments('id_notificacion');
            $table->integer('id_trabajador_emisor')->unsigned();
            $table->foreign('id_trabajador_emisor')
                  ->references('id_trabajador')
                  ->on('trabajadores')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  
            $table->integer('id_trabajador_destino')->nullable()->unsigned();
            $table->foreign('id_trabajador_destino')
                  ->references('id_trabajador')
                  ->on('trabajadores')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');        
            $table->integer('id_grupo')->nullable()->unsigned();
            $table->foreign('id_grupo')
                  ->references('id_grupo')
                  ->on('cat_grupos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_alumno')->nullable()->unsigned();
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_rol')->nullable()->unsigned();    
            $table->foreign('id_rol')
                  ->references('id_rol')
                  ->on('cat_roles')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  
            $table->text('mensaje')->nullable();
            $table->date('caducidad');
            $table->boolean('publicar')->default(false);
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
        Schema::dropIfExists('notificaciones');
    }
}
