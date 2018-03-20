<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\BookingSubmitted;
use App\Mail\BookingConfirmed;
use Validator;

class BookingController extends Controller
{
    public function submit(Request $request)
    {
    	try
    	{
    		$booking = new \App\Booking;

    		$booking->booking_no = uniqid();
    		$booking->travel_date = $request->selectedDate;
    		$booking->tour_price_id = $request->travel_options;
    		$booking->tour_id = $request->tour_id;
    		$booking->firstname = $request->firstname;
    		$booking->middlename = $request->middlename;
    		$booking->lastname = $request->lastname;
    		$booking->email = $request->email;
            $booking->contact_no = $request->contact_no;
    		$booking->nationality = $request->nationality;
    		$booking->status = 'pending';
    		$booking->payed_at = null;

    		if ($booking->save())
    		{
                $bookings = \App\Booking::findOrFail($booking->id);
                //Mail::to($request->email)->send(new BookingSubmitted($bookings));
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
        $bookings = \App\Booking::paginate(5);

        return view('backend.pages.booking.all', [
            'active_link' => 'bookings',
            'bookings' => $bookings
        ]);
    }

    public function all(Request $request)
    {

    }

    public function complete_view($booking_no)
    {
        $count = \App\Booking::where('booking_no', $booking_no)->where('status', 'pending')->count();

        if ($count < 1)
        {
            abort(404);
        }

        $booking = \App\Booking::where('booking_no', $booking_no)->first();

        return view('frontend.pages.booking.complete', [
            'active_link' => '',
            'b' => $booking
        ]);
    }

    public function complete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'control_no' => 'required',
            'payed_in' => 'required'
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $booking = \App\Booking::where('booking_no', $request->booking_no)->first();

        $booking->status = 'payed';
        $booking->control_no = $request->input('control_no');
        $booking->payed_in = $request->input('payed_in');
        $booking->payed_at = date('Y-m-d H:i:s');
        if ($booking->save())
        {
            return redirect()->route('booking.thank-you');
        }
    }

    public function thank_you()
    {
        return view('frontend.pages.booking.thank-you', [
            'active_link' => ''
        ]);
    }

    public function show($booking_id)
    {
        $booking = \App\Booking::findOrFail($booking_id);
        return view('backend.pages.booking.show', [
            'active_link' => 'bookings',
            'booking' => $booking
        ]);
    }

    public function show_payed($booking_no)
    {
        $count = \App\Booking::where('booking_no', $booking_no)->count();

        if ($count < 1)
        {
            abort(404);
        }

        $booking = \App\Booking::where('booking_no', $booking_no)->first();

        return view('frontend.pages.booking.confirmed', [
            'active_link' => '',
            'b' => $booking
        ]);
    }
    public function status_update(Request $request)
    {
        $booking = \App\Booking::findOrFail($request->booking_id);
        $booking->status = $request->status;
        if ($booking->save())
        {
            if ($request->status == 'confirmed')
            {
                Mail::to($booking->email)->send(new BookingConfirmed($booking));
            }

            session()->flash('status', 'ok');
            return redirect()->route('booking.show', ['booking_id' => $request->booking_id]);
        }
    }
}
