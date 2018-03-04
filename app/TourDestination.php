<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourDestination extends Model
{
    protected $table = 'tour_destinations';

    protected $fillable = [
    	'tour_id', 'address', 'lat', 'lng', 'fee', 'filepath'
    ];

    public function tour()
    {
    	return $this->belongsTo('App\Tour');
    }
}
