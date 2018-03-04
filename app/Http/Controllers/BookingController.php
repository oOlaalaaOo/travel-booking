<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function submit(Request $request)
    {
    	try
    	{
    		$booking = new \App\Booking;

    		$booking->booking_no = uniqid();
    		$booking->travel_date = $request->year . '-' . $request->month . '-' . $request->day;
    		$booking->tour_price_id = $request->travel_options;
    		$booking->tour_id = $request->tour_id;
    		$booking->firstname = $request->firstname;
    		$booking->middlename = $request->middlename;
    		$booking->lastname = $request->lastname;
    		$booking->email = $request->email;
    		$booking->contact_no = $request->contact_no;
    		$booking->status = 'pending';
    		$booking->payed_at = null;

    		if ($booking->save())
    		{
    			return response()->json(['status' => 'ok'], 200);
    		}
    		return response()->json(['status' => 'fail'], 200);
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['error' => $e->getMessage()]);
    	}
    }

    public function all_view()
    {
        $bookings = \App\Booking::all();

        return view('backend.pages.booking.all', [
            'active_link' => 'bookings',
            'bookings' => $bookings
        ]);
    }

    public function all()
    {

    }
}
