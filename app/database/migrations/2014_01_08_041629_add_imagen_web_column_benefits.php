<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagenWebColumnBenefits extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficios', function(Blueprint $table)
        {
            $table->string('imagen_grande_web', 200)->nullable();
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
            $table->dropColumn('imagen_grande_web');
        });
    }

}