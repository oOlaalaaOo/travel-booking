<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use Hash;
class AccountController extends Controller
{
    public function __construct()
    {

    }

    public function profile_view()
    {
    	return view('backend.pages.account.profile', [
    		'active_link' => 'profile',
    	]);
    }

    public function profile()
    {
    	try
    	{
    		return response()->json(['profile' => Auth::user()], 200);
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage()], 500);
    	}
    }

    public function update_profile(Request $request)
    {
    	try
        {
            $user = \App\User::findOrFail(Auth::user()->id);

            if ($request->has('photo') && $request->input('photo') != '')
            {
                $exploded = explode(',', $request->input('photo'));

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

                $user->name = $request->input('name');
                $user->description = $request->input('description');
                $user->photo = env('APP_URL') . 'uploads/' . $filename;

                if ($user->save())
                {
                    return response()->json(['status' => 'ok']);
                }

                return response()->json(['status' => 'fail']);
            }

            $user->name = $request->input('name');
            $user->description = $request->input('description');

            if ($user->save())
            {
                return response()->json(['status' => 'ok'], 200);
            }

            return response()->json(['status' => 'fail'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 403);
        }
    }

    public function credentials_view()
    {
    	return view('backend.pages.account.credentials', [
    		'active_link' => 'credentials',
    	]);
    }

    public function credentials()
    {
    	try
    	{
    		return response()->json(['credentials' => Auth::user()], 200);
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage()], 500);
    	}
    }

    public function update_username(Request $request)
    {
    	try
    	{
    		$user = Auth::user();

	    	$user->email = $request->input('email');

	    	if ($user->save())
	    	{
	    		return response()->json(['status' => 'ok'], 200);
	    	}

	    	return response()->json(['status' => 'fail'], 200);
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage()], 403);
    	}
    }

    public function update_password(Request $request)
    {
    	try
    	{
    		$user = User::findOrFail(Auth::user()->id);

    		if (Hash::check($request->input('current_password'), $user->password)) 
    		{
			    $user->password = bcrypt($request->input('password'));

	    		if ($user->save())
		    	{
		    		return response()->json(['status' => 'ok'], 200);
		    	}

		    	return response()->json(['status' => 'fail'], 200);
				}
			else
			{
				return response()->json(['status' => 'wrong'], 200);
			}
    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage()], 403);
    	}
    }
}
