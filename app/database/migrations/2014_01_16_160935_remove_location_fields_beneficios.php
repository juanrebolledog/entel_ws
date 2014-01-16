<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLocationFieldsBeneficios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('beneficios', function(Blueprint $table)
		{
			$table->dropColumn(array('lugar', 'lat', 'lng'));
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
			$table->string('lugar', 100);
			$table->float('lat');
			$table->float('lng');
		});
	}

}