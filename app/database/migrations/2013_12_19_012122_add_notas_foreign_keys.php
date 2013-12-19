<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotasForeignKeys extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notas', function(Blueprint $table)
        {
            $table->foreign('beneficio_id')->references('id')->on('beneficios')
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
        Schema::table('notas', function(Blueprint $table)
        {
            $table->dropForeign('beneficio_id');
            $table->dropForeign('usuario_id');
        });
    }

}