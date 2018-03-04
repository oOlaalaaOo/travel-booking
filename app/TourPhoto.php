<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourPhoto extends Model
{
    protected $table = 'tour_photos';

    protected $fillable = [
    	'tour_id', 'filepath'
    ];
}
