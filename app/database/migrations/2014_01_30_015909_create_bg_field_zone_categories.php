<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBgFieldZoneCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('puntos_zonas_categorias', function(Blueprint $table)
		{
			$table->string('imagen_fondo', 200)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('puntos_zonas_categorias', function(Blueprint $table)
		{
			$table->dropColumn('imagen_fondo');
		});
	}

}