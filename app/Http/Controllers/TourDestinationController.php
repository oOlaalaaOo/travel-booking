<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourDestinationController extends Controller
{
    public function __construct()
    {

    }

    public function add(Request $request)
    {
    	try
    	{
    		$destination = new \App\TourDestination;

	    	$destination->tour_id = $request->input('tour_id');
	    	$destination->address = $request->input('name');
	    	$destination->fee = $request->input('fee');

	    	if ($destination->save())
	    	{
	    		return response()->json(['status' => 'ok']);
	    	}

	    	return response()->json(['status' => 'fail']);
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage()]);
    	}
    	
    }

    public function delete(Request $request)
    {
        try
        {
            $destination = \App\TourDestination::findOrFail($request->input('destination_id'));
            if ($destination->delete())
            {
                return response()->json(['status' => 'ok']);
            }
            return response()->json(['status' => 'fail']);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
}
