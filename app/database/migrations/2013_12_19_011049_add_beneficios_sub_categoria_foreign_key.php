<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBeneficiosSubCategoriaForeignKey extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficios', function(Blueprint $table)
        {
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias_beneficios')
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
        Schema::table('beneficios', function(Blueprint $table)
        {
            $table->dropForeign('sub_categoria_id');
        });
    }

}