<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsuariosNivelForeignKey extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function(Blueprint $table)
        {
            $table->foreign('nivel_id')->references('id')->on('usuarios_niveles')
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
        Schema::table('usuarios', function(Blueprint $table)
        {
            $table->dropForeign('nivel_id');
        });
    }

}