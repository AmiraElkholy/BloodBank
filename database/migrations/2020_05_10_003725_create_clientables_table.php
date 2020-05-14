<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientablesTable extends Migration {

	public function up()
	{
		Schema::create('clientables', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			$table->integer('client_id')->unsigned();
			$table->integer('clientable_id');
			$table->string('clientable_type');
			$table->boolean('is_seen')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clientables');
	}
}