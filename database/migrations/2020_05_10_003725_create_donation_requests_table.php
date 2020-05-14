<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation-requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			$table->string('patient_name');
			$table->string('patient_phone');
			$table->integer('patient_age');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('number_of_bags');
			$table->string('hospital_name');
			$table->integer('city_id')->unsigned();
			$table->text('hospital_address');
			$table->text('notes')->nullable();
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 11,8);
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation-requests');
	}
}