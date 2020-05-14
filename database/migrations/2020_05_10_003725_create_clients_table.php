<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			// $table->timestamps();
			$table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			$table->string('phone')->unique();
			$table->string('password');
			$table->string('name');
			$table->string('email')->unique();
			$table->date('date_of_birth');
			$table->integer('blood_type_id')->unsigned();
			$table->date('last_donation_date');
			$table->integer('city_id');
			$table->string('pin_code')->unique()->nullable();
			$table->string('api_token', 60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}