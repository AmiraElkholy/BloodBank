<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'donation_request_id');

    public function donationRequest()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

}