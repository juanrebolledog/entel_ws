<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeranosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veranos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->on('veranos_categorias')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('descripcion', 150);
            $table->string('descripcion_larga', 300);
            $table->string('texto_beneficio', 50);
            $table->string('horario', 100);
            $table->string('lugar', 100);
            $table->date('fecha');
            $table->string('legal', 300);
            $table->string('sms_nro', 10);
            $table->string('sms_texto', 10);
            $table->string('imagen_descripcion', 100);
            $table->string('imagen_titulo', 100);
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
        Schema::drop('veranos');
    }

}
