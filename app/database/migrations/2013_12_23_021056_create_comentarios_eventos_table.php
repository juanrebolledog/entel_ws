<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosEventosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios_eventos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('evento_id');
            $table->foreign('evento_id')->references('id')->on('eventos')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('mensaje', 300);
            $table->boolean('eliminado')->default(false);
            $table->boolean('compartido_fb')->default(false);
            $table->boolean('compartido_tw')->default(false);
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
        Schema::drop('comentarios_eventos');
    }

}
