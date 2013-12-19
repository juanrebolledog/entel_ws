<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('nivel_id')->unsigned()->nullable();
            $table->string('rut', 45);
            $table->string('telefono_movil', 45);
            $table->string('nombres', 300);
            $table->string('genero', 10)->nullable();
            $table->string('email', 64);
            $table->string('password', 64)->nullable();
            $table->dateTime('ultimo_login')->nullable();
            $table->string('android_device_id', 64)->nullable();
            $table->string('ios_device_id', 64)->nullable();
            $table->string('api_key', 64)->nullable();
            $table->string('fb_id', 64)->nullable();
            $table->string('fb_access_token', 64)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }

}
