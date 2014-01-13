<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comunas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('region_id')->unsigned();
			$table->foreign('region_id')->on('regiones')->references('id')
				->onUpdate('cascade')->onDelete('cascade');
			$table->string('nombre', 50);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comunas');
	}

}
