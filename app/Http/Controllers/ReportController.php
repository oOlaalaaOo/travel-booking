<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ReportController extends Controller
{
    public function report()
    {
        return view('backend.pages.report.report', [
            'active_link' => 'report',
        ]);
    }

    public function booking_report()
    {
    	try
    	{
    		//$confirmed = DB::table('bookings')->where('status', 'confirmed')->count();

	    	$bookings = DB::table('bookings')->get();

	    	$all = [];
	    	$confirmed = [];
	    	$pending = [];
	    	$payed = [];
	    	$dates = DB::table('bookings')
	    					->selectRaw('DISTINCT(DATE(created_at)) as days')
	    					->get();

	    	foreach ($bookings as $b)
	    	{
	    		

	    		$all[date('Y-m-d', strtotime($b->created_at))] = DB::table('bookings')
	    					->selectRaw('DISTINCT(DATE(created_at)) as days')
	    					->whereDate('created_at', date('Y-m-d', strtotime($b->created_at)))
	    					->count();

	    		$confirmed[date('Y-m-d', strtotime($b->created_at))] = DB::table('bookings')
	    					->selectRaw('DISTINCT(DATE(created_at)) as days')
	    					->where('status', 'confirmed')
	    					->whereDate('created_at', date('Y-m-d', strtotime($b->created_at)))
	    					->count();

	    		$pending[date('Y-m-d', strtotime($b->created_at))] = DB::table('bookings')
	    					->selectRaw('DISTINCT(DATE(created_at)) as days')
	    					->where('status', 'pending')
	    					->whereDate('created_at', date('Y-m-d', strtotime($b->created_at)))
	    					->count();

	    		$payed[date('Y-m-d', strtotime($b->created_at))] = DB::table('bookings')
	    					->selectRaw('DISTINCT(DATE(created_at)) as days')
	    					->where('status', 'payed')
	    					->whereDate('created_at', date('Y-m-d', strtotime($b->created_at)))
	    					->count();
	    	}

	    	return response()->json(['all' => $all, 'confirmed' => $confirmed, 'pending' => $pending, 'payed' => $payed, 'dates' => $dates], 200);
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage], 403);
    	}
    	

    }
}
