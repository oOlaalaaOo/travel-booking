<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourPhotoController extends Controller
{
    public function add(Request $request)
    {
    	try
    	{
			$exploded = explode(',', $request->input('image'));

			$decoded = base64_decode($exploded[1]);

			$extension = '';
			
			if (str_contains($exploded[0], 'jpeg'))
			{
				$extension = 'jpg';
			}
			else
			{
				$extension = 'png';
			}

			$filename = str_random() . '.' . $extension;

			$path = public_path() . '/uploads//' . $filename;

			file_put_contents($path, $decoded);

    		$photos = new \App\TourPhoto;
	    	$photos->tour_id = $request->input('tour_id');
	    	$photos->filepath = env('APP_URL') . 'uploads/' . $filename;

	    	if ($photos->save())
	    	{
	    		return response()->json(['status' => 'ok'], 200);
	    	}

	    	return response()->json(['status' => 'fail'], 200);

    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['error' => $e->getMessage()], 403);
    	}
    	
    }
}
