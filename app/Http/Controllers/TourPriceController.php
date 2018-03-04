<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TourPrice;

class TourPriceController extends Controller
{
    public function __construct()
    {

    }

    public function add(Request $request)
    {
    	try
    	{
    		$price = new TourPrice;

	    	$price->tour_id = $request->input('tour_id');
	    	$price->type = $request->input('type');
	    	$price->capacity_type = $request->input('capacity_type');
	    	$price->capacity = $request->input('capacity');
	    	$price->price = $request->input('price');

	    	if ($price->save())
	    	{
	    		return response()->json(['status' => 'ok'], 200);
	    	}

	    	return response()->json(['status' => 'fail'], 200);
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage()]);
    	}
    	
    }

    public function all($tour_id)
    {
    	try
    	{
    		$prices = TourPrice::where('tour_id', $tour_id)->get();

    		return response()->json([
    			'prices' => $prices
    		]);
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage()]);
    	}
    }

    public function show($id)
    {
        try
        {
            $price = TourPrice::findOrFail($id);

            return response()->json([
                'price' => $price
            ]);
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
            $price = TourPrice::findOrFail($request->input('price_id'));

            if ($price->delete())
            {
                return response()->json(['status' => 'ok'], 200);
            }
            return response()->json(['status' => 'fail'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try
        {
            $price = TourPrice::findOrFail($request->input('price_id'));

            $price->type = $request->input('type');
            $price->capacity_type = $request->input('capacity_type');
            $price->capacity = $request->input('capacity');
            $price->price = $request->input('price');

            if ($price->save())
            {
                return response()->json(['status' => 'ok'], 200);
            }
            return response()->json(['status' => 'fail'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
}
