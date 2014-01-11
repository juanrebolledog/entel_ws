<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFechaColumnToDate extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos', function(Blueprint $table)
        {
            $table->dropColumn('fecha');
        });

        Schema::table('eventos', function(Blueprint $table)
        {
            $table->date('fecha')->nullable();
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
            $table->dropColumn('fecha');
        });

        Schema::table('eventos', function(Blueprint $table)
        {
            $table->string('fecha', 100);
        });
    }

}