<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriasEventosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categorias_eventos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('categoria_id')->unsigned()->nullable();
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
        Schema::drop('sub_categorias_eventos');
    }

}
