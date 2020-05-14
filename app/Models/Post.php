<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'image', 'category_id');
    protected $appends = array('full_thumbnail_path');
        // , 'is_favourite');

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }



    //********** Accessors & Mutators ********//

    public function getFullThumbnailPathAttribute() {
        return asset($this->image);
    }

    // public function getIsFavouriteAttribute() {
    //     return 
    // }

}