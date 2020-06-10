<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use URL;

use Carbon\Carbon;

class Post extends Model 
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'image', 'category_id', 'publish_date');
    //for api
    protected $appends = array('full_thumbnail_path', 'is_favourite', 'is_published');





    //********** Mutator ********/
    public function setPublishDate($value) {
        $this->attributes['publish_date'] = $value.toDateString();
    }



    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }


    //********** Accessors ********/

    public function getFullThumbnailPathAttribute() {
        return URL::to('/').'/images/'.$this->image;
    }

    public function getIsFavouriteAttribute() {
        return auth()->user()->posts->contains($this);
    }

    public function getIsPublishedAttribute() {
        return Carbon::parse($this->attributes['publish_date'])->lessThanOrEqualTo(Carbon::now());
    }

}