<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    public function login_view()
    {
    	return view('backend.pages.auth.login');
    }

    public function login(Request $request)
    {
    	try
    	{
    		if (Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')]))
    		{
    			return response()->json(['status' => 'ok'], 200);
    		}
    		return response()->json(['status' => 'fail'], 200);

    	}
    	catch(\Exception $e)
    	{
    		return response()->json(['errors' => $e->getMessage()], 500);
    	}
    }

    public function logout()
    {
    	Auth::logout();
        
        return redirect()->route('admin.login');
    }
}
