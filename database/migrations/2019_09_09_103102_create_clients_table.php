<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->timestamps();
			$table->string('name');
			$table->string('password');
			$table->increments('id');
			$table->string('email');
			$table->string('phone');
			$table->string('pin_code');
			$table->date('data_of_birthday');
			$table->date('last_donation_date');
			$table->integer('city_id')->unsigned();
			$table->enum('blood_type',array('A+','A-','B+','B-','O+','O-','AB+','AB-'));
		  $table->string('api_token',60)->unique()->nullable();
			$table->boolean('is_active')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
