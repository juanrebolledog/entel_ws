<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntosZonasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos_zonas', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->on('puntos_zonas_categorias')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('url', 200);
            $table->string('imagen', 200);
            $table->string('imagen_web', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('puntos_zonas');
    }

}
