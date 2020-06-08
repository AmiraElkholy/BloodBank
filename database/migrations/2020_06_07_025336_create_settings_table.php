<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->mediumText('notification_settings_text');
			$table->mediumText('about_app_text');
			$table->mediumText('about_app_text_2');
			$table->mediumText('about_app_text_3');
			$table->longText('about_us_text');
			$table->string('email');
			$table->string('phone');
			$table->string('fb_link');
			$table->string('tw_link');
			$table->string('insta_link');
			$table->string('whats_number');
			$table->mediumText('whats_link');
			$table->string('youtube_link')->nullable();
			$table->text('intro_text');
			$table->string('mobile_app_text');
			$table->string('g_play_link');
			$table->string('apple_store_link');
			$table->string('fax_number')->nullable();
			$table->mediumText('footer_text');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}