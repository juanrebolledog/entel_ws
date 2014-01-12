<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcursosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concursos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('descripcion', 300);
            $table->string('imagen_banner', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('concursos');
    }

}
