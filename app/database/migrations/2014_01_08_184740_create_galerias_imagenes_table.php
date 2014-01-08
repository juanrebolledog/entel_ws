<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleriasImagenesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galerias_imagenes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('galeria_id')->unsigned();
            $table->foreign('galeria_id')->on('galerias_sociales')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('imagen');
            $table->string('descripcion');
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
        Schema::drop('galerias_imagenes');
    }

}
