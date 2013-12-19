<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComentariosCompartidosForeignKeys extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comentarios_compartidos', function(Blueprint $table)
        {
            $table->foreign('comentario_id')->references('id')->on('comentarios')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comentarios_compartidos', function(Blueprint $table)
        {
            $table->dropForeign('comentario_id');
            $table->dropForeign('usuario_id');
        });
    }

}