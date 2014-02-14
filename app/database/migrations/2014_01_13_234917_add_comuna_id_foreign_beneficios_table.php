<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComunaIdForeignBeneficiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('beneficios', function(Blueprint $table)
		{
			$table->integer('comuna_id')->unsigned();
			$table->foreign('comuna_id')->on('comunas')->references('id');
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
			$table->dropForeign('beneficios_comuna_id_foreign');
			$table->dropColumn('comuna_id');
		});
	}

}