<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationTokensTable extends Migration {

	public function up()
	{
		Schema::create('notification_tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->string('token');
			$table->enum('platform', array('android', 'ios'));
		});
	}

	public function down()
	{
		Schema::drop('notification_tokens');
	}
}