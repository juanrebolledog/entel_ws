<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('beneficio_id')->unsigned()->nullable();
            $table->integer('usuario_id')->unsigned()->nullable();
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
        Schema::drop('comentarios');
    }

}
