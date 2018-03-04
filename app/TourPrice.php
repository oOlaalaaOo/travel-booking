<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourPrice extends Model
{
    protected $table = 'tour_prices';

    protected $fillable = [
    	'tour_id', 'type', 'capacity_type', 'capacity', 'price'
    ];

    public function tour()
    {
    	return $this->belongsTo('App\Tour');
    }
}
