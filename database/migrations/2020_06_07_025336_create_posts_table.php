<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title')->unique();
			$table->text('body');
			$table->string('image');
			$table->integer('category_id')->unsigned();
			$table->datetime('publish_date');
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}