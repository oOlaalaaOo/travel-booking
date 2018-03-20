<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;

use App\Mail\ContactUsRequest;
use Mail;
use DB;

class PageController extends Controller
{
    protected $site_name;

    public function __construct()
    {
        $content = DB::table('configuration_contents')->where('title', 'site_name')->first();
        $this->site_name = $content->content;
    }

    public function our_company()
    {
        $company = \App\ConfigurationContent::where('title', 'company')->first();
    	return view('frontend.pages.our-company', [
            'active_link' => 'about-us',
            'company' => $company,
            'site_name' => $this->site_name
        ]);
    }

    public function mission_vision()
    {
        $mission = \App\ConfigurationContent::where('title', 'mission')->first();
        $vision = \App\ConfigurationContent::where('title', 'vision')->first();
    	return view('frontend.pages.mission', [
            'active_link' => 'about-us',
            'mission' => $mission,
            'vision' => $vision,
            'site_name' => $this->site_name
        ]);
    }

    public function news()
    {
        // $news = \App\Post::where('type', 'news')->get();

        // $updates = \App\Post::where('type', 'updates')->get();

        $posts = \App\Post::all();
         
    	return view('frontend.pages.news', [
            'active_link' => 'news',
            'posts' => $posts,
            'site_name' => $this->site_name
        ]);
    }

    public function show_post($post_id)
    {
        $post = \App\Post::findOrFail($post_id);

        return view('frontend.pages.show-post', [
            'active_link' => 'news',
            'post' => $post,
            'site_name' => $this->site_name
        ]);
    }

    public function contact_us()
    {
    	return view('frontend.pages.contact-us', [
            'active_link' => 'contact-us',
            'site_name' => $this->site_name
        ]);
    }

    public function send_contact_us(Request $request)
    {
        Mail::to('travelbooking68@gmail.com')->send(new ContactUsRequest($request->all()));
        session()->flash('status', 'ok');
        return redirect()->route('contact-us');
    }

    public function tour_packages()
    {
        return view('frontend.pages.tour-packages', [
            'active_link' => 'tour-packages',
            'site_name' => $this->site_name
        ]);
    }

    public function tour_package($tour_id)
    {
        $tour = Tour::findOrFail($tour_id);
        return view('frontend.pages.tour-package', [
            'active_link' => 'tour-packages',
            'tour' => $tour,
            'site_name' => $this->site_name
        ]);
    }

    public function site_contents()
    {
        return view('backend.pages.cms.site-contents', [
            'active_link' => 'site-contents',
            'site_name' => $this->site_name
        ]);
    }

    public function site_contents_data()
    {
        $company = \App\ConfigurationContent::where('title', 'company')->first();
        $mission = \App\ConfigurationContent::where('title', 'mission')->first();
        $vision = \App\ConfigurationContent::where('title', 'vision')->first();

        $site_name = \App\ConfigurationContent::where('title', 'site_name')->first();
        $site_email = \App\ConfigurationContent::where('title', 'site_email')->first();
        $site_address = \App\ConfigurationContent::where('title', 'site_address')->first();
        $site_telephone = \App\ConfigurationContent::where('title', 'site_telephone')->first();
        $site_mobile = \App\ConfigurationContent::where('title', 'site_mobile')->first();
        $book_guide = \App\ConfigurationContent::where('title', 'book_guide')->first();

        return response()->json([
            'company' => $company,
            'mission' => $mission,
            'vision' => $vision,
            'site_name' => $site_name,
            'site_email' => $site_email,
            'site_address' => $site_address,
            'site_telephone' => $site_telephone,
            'site_mobile' => $site_mobile,
            'book_guide' => $book_guide
        ], 200);
    }

    public function site_contents_update(Request $request)
    {
        $mission = \App\ConfigurationContent::where('title', 'mission')->first();

        $mission->content = $request->input('mission');
        $mission->save();

        $company = \App\ConfigurationContent::where('title', 'company')->first();

        $company->content = $request->input('company');
        $company->save();

        $vision = \App\ConfigurationContent::where('title', 'vision')->first();

        $vision->content = $request->input('vision');
        $vision->save();

        $site_name = \App\ConfigurationContent::where('title', 'site_name')->first();

        $site_name->content = $request->input('site_name');
        $site_name->save();

        $site_email = \App\ConfigurationContent::where('title', 'site_email')->first();

        $site_email->content = $request->input('site_email');
        $site_email->save();

        $site_address = \App\ConfigurationContent::where('title', 'site_address')->first();

        $site_address->content = $request->input('site_address');
        $site_address->save();

        $site_mobile = \App\ConfigurationContent::where('title', 'site_mobile')->first();

        $site_mobile->content = $request->input('site_mobile');
        $site_mobile->save();

        $site_telephone = \App\ConfigurationContent::where('title', 'site_telephone')->first();

        $site_telephone->content = $request->input('site_telephone');
        $site_telephone->save();

        $book_guide = \App\ConfigurationContent::where('title', 'book_guide')->first();

        $book_guide->content = $request->input('book_guide');
        $book_guide->save();

        return response()->json(['status' => 'ok'], 200);
    }

}
