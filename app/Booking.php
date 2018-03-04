<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    
    protected $fillable = [
    	'booking_no', 'travel_date', 'tour_price_id', 'tour_id', 'firstname', 'middlename', 'lastname', 'email', 'contact_no', 'status', 'payed_at'
    ];

    public function tour()
    {
    	return $this->belongsTo('App\Tour');
    }

    public function tour_price()
    {
    	return $this->belongsTo('App\TourPrice');
    }
}
