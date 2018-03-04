<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tours';

    protected $fillable = [
    	'tour_detail_id', 'tour_package_id', 'name', 'slug', 'description', 'notes', 'inclusions', 'published'
    ];

    public function tour_detail()
    {
    	return $this->hasOne('App\TourDetail');
    }

    public function photos()
    {
    	return $this->hasMany('App\TourPhoto');
    }

    public function destinations()
    {
        return $this->hasMany('App\TourDestination', 'tour_id');
    }

    public function prices()
    {
        return $this->hasMany('App\TourPrice');
    }
}
