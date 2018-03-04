<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourDetail extends Model
{
    protected $table = 'tour_details';

    protected $fillable = [
    	'tour_id', 'content', 'inclusions', 'notes'
    ];

    
}
