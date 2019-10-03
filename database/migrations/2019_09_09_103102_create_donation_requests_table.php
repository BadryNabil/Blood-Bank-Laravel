<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->string('patient_name');
			$table->enum('blood_type',array('A+','A-','B+','B-','o+','o-','AB+','AB-'));
		  $table->integer('city_id')->unsigned();
			$table->integer('phone');
			$table->integer('patient_age');
			$table->integer('bags_num');
			$table->string('hostipal_name');
			$table->string('hostipal_address');
			$table->text('notes');
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
