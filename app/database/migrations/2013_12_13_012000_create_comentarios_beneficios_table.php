<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosBeneficiosTable extends Migration {

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
            $table->foreign('beneficio_id')->on('beneficios')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->on('usuarios')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('mensaje', 300);
            $table->boolean('eliminado')->default(false);
            $table->boolean('compartido_fb')->default(false);
            $table->boolean('compartido_tw')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
