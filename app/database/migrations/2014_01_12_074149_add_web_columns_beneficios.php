<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebColumnsBeneficios extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficios', function(Blueprint $table)
        {
            $table->string('texto_beneficio', 50)->nullable();
            $table->string('sitio_web', 100)->nullable();
            $table->string('horario', 100)->nullable();
            $table->string('imagen_descripcion', 100)->nullable();
            $table->string('descripcion_larga', 500)->nullable();
            $table->string('texto_ubicacion', 100)->nullable();
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
            $table->dropColumn('texto_beneficio');
            $table->dropColumn('sitio_web');
            $table->dropColumn('horario');
            $table->dropColumn('imagen_descripcion');
            $table->dropColumn('descripcion_larga');
            $table->dropColumn('texto_ubicacion');
        });
    }

}