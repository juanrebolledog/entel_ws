<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescripcionFieldUserLevels extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_niveles', function(Blueprint $table)
        {
            $table->string('descripcion', 300)->default('Descripción de nivel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_niveles', function(Blueprint $table)
        {
            $table->dropColumn('descripcion');
        });
    }

}
