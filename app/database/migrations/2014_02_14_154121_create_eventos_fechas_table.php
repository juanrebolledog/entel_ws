<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosFechasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos_fechas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('evento_id')->unsigned();
			$table->foreign('evento_id')->on('eventos')->references('id')
				->onUpdate('cascade')->onDelete('cascade');
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
		Schema::drop('eventos_fechas');
	}

}
