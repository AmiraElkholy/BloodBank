<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name');
			$table->string('patient_phone');
			$table->integer('patient_age');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('number_of_bags');
			$table->string('hospital_name');
			$table->integer('city_id')->unsigned();
			$table->text('hospital_address');
			$table->text('notes');
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 11,8)->nullable();
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}