<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriasBeneficiosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categorias_beneficios', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->on('categorias_beneficios')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('banner', 100);
            $table->string('banner_link', 200);
            $table->string('icono', 100);
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
        Schema::drop('sub_categorias_beneficios');
    }

}
