<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('sub_categoria_id')->unsigned()->nullable();
            $table->foreign('sub_categoria_id')->on('categorias_eventos')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('descripcion', 300);
            $table->string('icono', 100);
            $table->string('imagen_grande', 100);
            $table->string('imagen_chica', 100);
            $table->string('imagen_titulo', 100);
            $table->string('imagen_grande_web', 100);
            $table->string('fecha', 100);
            $table->string('lugar', 100);
            $table->text('tags');
            $table->string('sms_texto', 45);
            $table->string('sms_nro', 45);
            $table->float('lat');
            $table->float('lng');
            $table->boolean('caducado')->default(false);
            $table->text('legal');
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
        Schema::drop('eventos');
    }

}
