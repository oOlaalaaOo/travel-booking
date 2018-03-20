<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {

    }

    public function dashboard()
    {
    	$bookings_today = \App\Booking::get();

    	return view('backend.pages.dashboard', [
    		'active_link' => 'dashboard',
    		'bookings_today' => $bookings_today
    	]);
    }
}
