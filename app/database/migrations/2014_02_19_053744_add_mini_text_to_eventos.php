<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMiniTextToEventos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos', function(Blueprint $table)
		{
			$table->string('mini_texto', 20);
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
			$table->dropColumn('mini_texto');
		});
	}

}