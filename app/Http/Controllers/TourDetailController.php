<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourDetailController extends Controller
{
    public function __construct()
    {

    }

    public function update(Request $request)
    {
    	$details = \App\TourDetail::findOrFail($request->input('tour_detail_id'))
    }
}
