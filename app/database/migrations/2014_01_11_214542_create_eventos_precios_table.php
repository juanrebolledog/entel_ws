<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosPreciosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos_precios', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('evento_id')->unsigned();
            $table->foreign('evento_id')->on('eventos')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('localidad', 100)->default('Localidad');
            $table->float('valor_normal')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('eventos_precios');
    }

}
