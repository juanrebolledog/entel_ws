<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebImageFieldZones extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puntos_zonas', function(Blueprint $table)
        {
            $table->string('imagen_web', 100)->default('');
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
            $table->dropColumn('imagen_web');
        });
    }

}