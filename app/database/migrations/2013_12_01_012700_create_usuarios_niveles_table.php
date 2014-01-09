<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosNivelesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_niveles', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('categoria', 45);
            $table->string('descripcion', 300);
            $table->integer('beneficios');
            $table->integer('comentarios');
            $table->integer('compartir');
            $table->string('imagen_on', 100);
            $table->string('imagen_off', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios_niveles');
    }

}
