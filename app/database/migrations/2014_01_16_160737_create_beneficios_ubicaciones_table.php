<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiosUbicacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('beneficios_ubicaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('beneficio_id')->unsigned();
			$table->foreign('beneficio_id')->on('beneficios')->references('id')
				->onUpdate('cascade')->onDelete('cascade');
			$table->string('lugar', 100);
			$table->float('lat');
			$table->float('lng');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('beneficios_ubicaciones');
	}

}
