<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPuntosZonasForeignKey extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puntos_zonas', function(Blueprint $table)
        {
            $table->dropForeign('puntos_zonas_categoria_id_foreign');
        });

        Schema::table('puntos_zonas', function(Blueprint $table)
        {
            $table->foreign('categoria_id')->on('puntos_zonas_sub_categorias')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('puntos_zonas', function(Blueprint $table)
	    {
		    $table->dropForeign('puntos_zonas_categoria_id_foreign');
	    });
    }

}