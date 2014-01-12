<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntosZonasSubCategoriasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos_zonas_sub_categorias', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('padre_id')->unsigned();
            $table->foreign('padre_id')->on('puntos_zonas_categorias')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('imagen_icono', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('puntos_zonas_sub_categorias');
    }

}
