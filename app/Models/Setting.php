<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('notification_settings_text', 'about_app_text', 'phone', 'email', 'fb_link', 'tw_link', 'insta_link', 'whats_link', 'whats_number', 'youtube_link', 'intro_text', 'about_app_text_2', 'about_app_text_3', 'mobile_app_text', 'g_play_link', 'apple_store_link', 'about_us_text', 'fax_number', 'footer_text');

}