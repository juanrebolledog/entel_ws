<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasEventosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_eventos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 45);
            $table->string('banner', 100);
            $table->string('banner_link', 100);
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
        Schema::drop('categorias_eventos');
    }

}
