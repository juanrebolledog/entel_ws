<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosUbicacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos_ubicaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('evento_id')->unsigned();
			$table->foreign('evento_id')->on('eventos')->references('id')
				->onUpdate('cascade')->onDelete('cascade');
			$table->string('lugar', 100);
			$table->decimal('lat', 18, 12);
			$table->decimal('lng', 18, 12);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eventos_ubicaciones');
	}

}
