<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCantidadFieldPuntosZonasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puntos_zonas', function(Blueprint $table)
        {
            $table->integer('cantidad')->unsigned()->default(0);
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
            $table->dropColumn('cantidad');
        });
    }

}