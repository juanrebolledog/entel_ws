<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventosSubCategoriaForeignKey extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos', function(Blueprint $table)
        {
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias_eventos')
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
        Schema::table('eventos', function(Blueprint $table)
        {
            $table->dropForeign('sub_categoria_id');
        });
    }

}