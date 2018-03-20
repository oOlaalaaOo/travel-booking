<?php
Route::get('/', function () {
	$tours = \App\Tour::all();
	$site_name = \DB::table('configuration_contents')->where('title', 'site_name')->first();
	$book_guide = \DB::table('configuration_contents')->where('title', 'book_guide')->first();
    $posts = \App\Post::latest()->take(3)->get();
    return view('frontend.pages.home', [
    	'active_link' => 'home',
    	'tours' => $tours,
    	'site_name' => $site_name->content,
    	'book_guide' => $book_guide->content,
        'posts' => $posts
    ]);
})->name('home');

Route::get('/login', function () {
	return redirect('/admin/login');
})->name('login');

Route::get('/tour-packages', 'PageController@tour_packages')->name('tour-packages');
Route::get('/tour-packages/{tour_id}', 'PageController@tour_package')->name('tour-package');

Route::get('/news', 'PageController@news')->name('news');

Route::get('/about-us/our-company', 'PageController@our_company')->name('our-company');

Route::get('/about-us/mission-vission', 'PageController@mission_vision')->name('mission-vision');

Route::get('/contact-us', 'PageController@contact_us')->name('contact-us');

Route::get('/admin/dashboard', 'DashboardController@dashboard')->name('admin.dashboard')->middleware('auth');

Route::get('/admin/tour/all', 'TourController@all_view')->name('admin.tour.all-view');

Route::post('/admin/tour/all', 'TourController@all')->name('admin.tour.all');
Route::post('/admin/tour/search', 'TourController@search')->name('admin.tour.search');

Route::get('/admin/tour/show/{tour_id}', 'TourController@show_view')->name('admin.tour.show-view');

Route::post('/admin/tour/show/{tour_id}', 'TourController@show')->name('admin.tour.show');

Route::get('/admin/tour/add', 'TourController@add_view')->name('admin.tour.add-view');

Route::post('/admin/tour/add', 'TourController@add')->name('admin.tour.add');

Route::post('/admin/tour/destination/add', 'TourDestinationController@add')->name('admin.tour.destination.add');

Route::post('/admin/tour/update', 'TourController@update')->name('admin.tour.update');

Route::post('/admin/tour/delete', 'TourController@delete')->name('admin.tour.delete');

Route::post('/admin/tour/destination/delete', 'TourDestinationController@delete')->name('admin.tour.destination.delete');

Route::post('/admin/tour/price/add', 'TourPriceController@add')->name('admin.tour.price.add');

Route::post('/admin/tour/price/update', 'TourPriceController@update')->name('admin.tour.price.update');
Route::post('/admin/tour/price/delete', 'TourPriceController@delete')->name('admin.tour.price.delete');
Route::get('/admin/tour/price/all/{tour_id}', 'TourPriceController@all')->name('admin.tour.price.all');
Route::get('/admin/tour/price/show/{id}', 'TourPriceController@show')->name('admin.tour.price.show');

Route::get('/admin/post/all', 'PostController@all_view')->name('admin.post.all-view');
Route::post('/admin/post/all', 'PostController@all')->name('admin.post.all');
Route::get('/admin/post/add', 'PostController@add_view')->name('admin.post.add-view');
Route::post('/admin/post/add', 'PostController@add')->name('admin.post.add');
Route::get('/admin/post/show/{post_id}', 'PostController@show_view')->name('admin.post.show-view');
Route::post('/admin/post/show/{post_id}', 'PostController@show')->name('admin.post.show');
Route::post('/admin/post/update', 'PostController@update')->name('admin.post.update');
Route::post('/admin/post/delete', 'PostController@delete')->name('admin.post.delete');

Route::get('/admin/login', 'AuthController@login_view')->name('admin.login-view');
Route::post('/admin/login', 'AuthController@login')->name('admin.login');

Route::get('/admin/logout', 'AuthController@logout')->name('admin.logout');

Route::get('/admin/account/profile', 'AccountController@profile_view')->name('admin.account.profile-view');
Route::post('/admin/account/profile', 'AccountController@profile')->name('admin.account.profile');
Route::post('/admin/account/profile/update', 'AccountController@update_profile')->name('admin.account.profile.update');
Route::get('/admin/account/credentials', 'AccountController@credentials_view')->name('admin.account.credentials-view');
Route::post('/admin/account/credentials', 'AccountController@credentials')->name('admin.account.credentials');
Route::post('/admin/account/credentials/update', 'AccountController@update_credentials')->name('admin.account.credentials.update');
Route::post('/admin/account/credentials/username/update', 'AccountController@update_username')->name('admin.account.credentials.username.update');
Route::post('/admin/account/credentials/password/update', 'AccountController@update_password')->name('admin.account.credentials.password.update');
Route::get('/news/show/{post_id}', 'PageController@show_post')->name('post.show');

Route::get('/admin/site-contents', 'PageController@site_contents')->name('admin.site-contents');

Route::post('/admin/site-contents', 'PageController@site_contents_data')->name('admin.site-contents.data');
Route::post('/admin/site-contents/update', 'PageController@site_contents_update')->name('admin.site-contents.update');

Route::post('/booking/submit', 'BookingController@submit')->name('booking.submit');
Route::post('/admin/booking/all', 'BookingController@all')->name('admin.booking.all');
Route::get('/admin/booking/all', 'BookingController@all_view')->name('admin.booking.all-view');

Route::get('/booking/complete/{booking_no}', 'BookingController@complete_view')->name('booking.complete-view');

Route::post('/booking/complete', 'BookingController@complete')->name('booking.complete');
Route::get('/booking/thank-you', 'BookingController@thank_you')->name('booking.thank-you');

Route::get('/booking/show/{booking_id}', 'BookingController@show')->name('booking.show');
Route::get('/booking/show/payed/{booking_no}', 'BookingController@show_payed')->name('booking.show.payed');

Route::post('/booking/status/update', 'BookingController@status_update')->name('booking.status.update');

Route::post('/contact-us/send', 'PageController@send_contact_us')->name('contact-us.send');

Route::get('/admin/report', 'ReportController@report')->name('admin.report');
Route::get('/admin/report/bookings', 'ReportController@booking_report')->name('admin.report.booking');

Route::post('/admin/photos/add', 'TourPhotoController@add')->name('admin.photos.add');