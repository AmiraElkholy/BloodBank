<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model 
{

    protected $table = 'donation-requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_phone', 'patient_age', 'blood_type_id', 'number_of_bags', 'hospital_name', 'city_id', 'hospital_address', 'notes', 'latitude', 'longitude', 'client_id');

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

}