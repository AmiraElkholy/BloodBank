<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Foundation\Auth\User as Authenticatable;


use Laravel\Passport\HasApiTokens;


use Carbon\Carbon;

use App\Notifications\ClientResetPasswordNotification;


class Client extends Authenticatable {

    use Notifiable;


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPasswordNotification($token));
    }


    protected $table = 'clients';
    

    protected $guard = ['api', 'client-web'];


    public $timestamps = true;

    
    protected $fillable = [
        'phone', 'password', 'name', 'email', 'date_of_birth', 'blood_type_id', 'last_donation_date', 'city_id', 'pin_code'
    ];

    
    protected $hidden = [
        'password', 'api_token', 'pin_code', 'remember_token', 
    ];



    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }


    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }


    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'clientable');
    }


    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }


    public function notifications()
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable');
    }


    public function bloodTypes()
    {
        return $this->morphedByMany('App\Models\BloodType', 'clientable');
    }


    public function governorates()
    {
        return $this->morphedByMany('App\Models\Governorate', 'clientable');
    }


    public function notificationTokens()
    {
        return $this->hasMany('App\Models\NotificationToken');
    }


    // Mutators
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }


    //Accessors
    public function getDateOfBirthAttribute($value) {
        return Carbon::parse($value)->format('Y-n-j');
    }


    public function getLastDonationDateAttribute($value) {
        return Carbon::parse($value)->format('Y-n-j');
    }


}