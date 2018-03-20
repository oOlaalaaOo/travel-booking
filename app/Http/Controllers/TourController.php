<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;
use App\TourPhoto;

class TourController extends Controller
{
    public function __construct()
    {

    }

    public function all_view()
    {
        $tours = Tour::all();

    	return view('backend.pages.tour.all', [
            'active_link' => 'tour-package',
            'tours'       => $tours
        ]);
    }

    public function all()
    {
        try
        {
            $tours = Tour::all();

            return response()->json([
                'tours' => $tours
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        try
        {
            $tours = \DB::table('tours')->where('name', 'like', '%'.$request->input('tour_package').'%')->get();

            return response()->json([
                'tours' => $tours
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function add_view()
    {
    	return view('backend.pages.tour.add', [
            'active_link' => 'tour-package'
        ]);
    }

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

            $name_replaced = str_replace(' ', '-', $request->input('name'));
            $name_lowered = strtolower($name_replaced);

            $tour = new Tour;
            $tour->name = $request->input('name');
            $tour->slug = $name_lowered;
            $tour->description = $request->input('description');
            $tour->description_quick = $request->input('xdescription');
            $tour->main_image = env('APP_URL') . 'uploads/' . $filename;
            $tour->notes = $request->input('notes');
            $tour->inclusions = $request->input('inclusions');
            $tour->from_date = $request->input('from_date');
            $tour->to_date = $request->input('to_date');
            $tour->published = false;

            if ($tour->save())
            {
                return response()->json(['status' => true], 200);
            }

            return response()->json(['status' => false]);
        } 
        catch (\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function show($tour_id)
    {
        try
        {
            $tour = Tour::findOrFail($tour_id);

            $destinations = Tour::findOrFail($tour_id)->destinations;

            $details = Tour::findOrFail($tour_id)->details;
            
            $prices = Tour::findOrFail($tour_id)->prices;

            $photos = Tour::findOrFail($tour_id)->photos;

            return response()->json([
                'tour'          => $tour, 
                'destinations'  => $destinations,
                'details'       => $details,
                'prices'        => $prices,
                'photos'        => $photos
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function show_view($tour_id)
    {
        $tour = Tour::findOrFail($tour_id);
        $photos = Tour::findOrFail($tour_id)->photos();

        return view('backend.pages.tour.show', [
            'active_link'   => 'tour-package',
            'tour'          => $tour,
            'photos'        => $photos
        ]);
    }

    public function update(Request $request)
    {
        try
        {
            $tour = Tour::findOrFail($request->input('tour_id'));

            if ($request->has('image') && $request->input('image') != '')
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

                $tour->name = $request->input('name');
                $tour->description = $request->input('description');
                $tour->description_quick = $request->input('description_quick');
                $tour->notes = $request->input('notes');
                $tour->inclusions = $request->input('inclusions');
                $tour->main_image = env('APP_URL') . 'uploads/' . $filename;

                if ($tour->save())
                {
                    return response()->json(['status' => 'ok']);
                }

                return response()->json(['status' => 'fail']);
            }

            $tour->name = $request->input('name');
            $tour->description = $request->input('description');
            $tour->description_quick = $request->input('description_quick');
            $tour->notes = $request->input('notes');
            $tour->inclusions = $request->input('inclusions');
            $tour->from_date = $request->input('from_date');
            $tour->to_date = $request->input('to_date');
            if ($tour->save())
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
            $tour = Tour::findOrFail($request->input('tour_id'));

            if ($tour->delete())
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
