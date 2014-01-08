<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleriasSocialesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galerias_sociales', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->date('fecha');
            $table->string('imagen_web');
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
        Schema::drop('galerias_sociales');
    }

}
