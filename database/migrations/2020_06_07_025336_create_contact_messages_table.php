<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactMessagesTable extends Migration {

	public function up()
	{
		Schema::create('contact_messages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('phone');
			$table->string('subject');
			$table->text('body');
			$table->string('email');
		});
	}

	public function down()
	{
		Schema::drop('contact_messages');
	}
}