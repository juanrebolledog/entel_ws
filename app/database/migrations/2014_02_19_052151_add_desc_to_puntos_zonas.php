<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescToPuntosZonas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('puntos_zonas', function(Blueprint $table)
		{
			$table->string('descripcion', 100);
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
			$table->dropColumn('descripcion');
		});
	}

}