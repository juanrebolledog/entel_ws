<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKbTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ayuda_kb', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('key', 50);
			$table->string('titulo', 200);
			$table->string('cover', 100);
			$table->string('icono', 100);
			$table->text('articulos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ayuda_kb');
	}

}
