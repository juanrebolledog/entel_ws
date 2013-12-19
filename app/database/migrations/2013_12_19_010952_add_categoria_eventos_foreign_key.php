<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriaEventosForeignKey extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_categorias_eventos', function(Blueprint $table)
        {
            $table->foreign('categoria_id')->references('id')->on('categorias_eventos')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_categorias_eventos', function(Blueprint $table)
        {
            $table->dropForeign('categoria_id');
        });
    }

}