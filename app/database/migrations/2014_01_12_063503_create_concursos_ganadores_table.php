<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcursosGanadoresTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concursos_ganadores', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('concurso_id')->unsigned();
            $table->foreign('concurso_id')->on('concursos')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombres', 300);
            $table->string('rut', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('concursos_ganadores');
    }

}
