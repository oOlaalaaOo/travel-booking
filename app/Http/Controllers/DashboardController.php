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
    	return view('backend.pages.dashboard', [
    		'active_link' => 'dashboard'
    	]);
    }
}
