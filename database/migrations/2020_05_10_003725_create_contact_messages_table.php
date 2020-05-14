<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactMessagesTable extends Migration {

	public function up()
	{
		Schema::create('contact_messages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			$table->string('name');
			$table->string('phone');
			$table->string('subject');
			$table->text('body');
		});
	}

	public function down()
	{
		Schema::drop('contact_messages');
	}
}