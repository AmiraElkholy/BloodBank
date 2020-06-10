<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model 
{

    protected $table = 'contact_messages';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'subject', 'body', 'email');

}