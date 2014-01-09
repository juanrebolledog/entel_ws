<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiosImagenesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficios_imagenes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('beneficio_id')->unsigned();
            $table->foreign('beneficio_id')->on('beneficios')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('imagen', 200);
            $table->string('descripcion', 400);
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
        Schema::drop('beneficios_imagenes');
    }

}
