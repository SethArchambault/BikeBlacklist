<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

App::error(function($exception) {
    Log::error($exception);
    return Response::view('errors.missing', array(), 500);
});

App::missing(function($exception)
{
    Log::error($exception);
    return Response::view('errors.missing', array(), 404);
});

Route::get('/', array('as' => 'site.bikes', 'uses' => 'App\Controllers\SiteController@bikes'));
Route::get('/found/{bike_id}', array('as' => 'site.found', 'uses' => 'App\Controllers\SiteController@found'));
Route::get('/bike/{bike_uid}', array('as' => 'site.bike', 'uses' => 'App\Controllers\SiteController@bike'));
Route::get('/print/{bike_uid}', array('as' => 'site.print', 'uses' => 'App\Controllers\SiteController@print_bike'));
Route::post('/email', ['as' => 'site.email', 'uses' => 'App\Controllers\SiteController@email']);
Route::get('/feedback', ['as' => 'site.feedback', 'uses' => 'App\Controllers\SiteController@feedback']);
Route::post('/mail_feedback', ['as' => 'site.mail_feedback', 'uses' => 'App\Controllers\SiteController@mail_feedback']);
Route::get('/about', ['uses' => 'App\Controllers\SiteController@about']);
Route::get('/bike_stored', ['uses' => 'App\Controllers\SiteController@bike_stored']);

Route::get('/my-bike-is-missing', [
	'as' => 'site.my_bike_is_missing', 
	'uses' => 'App\Controllers\SiteController@my_bike_is_missing']);
Route::get('/more-details', [
	'as' => 'site.more_details',
	'uses' => 'App\Controllers\SiteController@more_details']);
Route::post('/store', array('as' => 'site.store', 'uses' => 'App\Controllers\SiteController@store'));
Route::post('/store_more_details', array('as' => 'site.store_more_details', 'uses' => 'App\Controllers\SiteController@store_more_details'));

Route::get('/login/', ['uses' => 'AdminController@login']);
Route::post('/admin/check_login', ['uses' => 'AdminController@check_login']);

// ADMIN
Route::group(['prefix' => 'admin', 'before' => 'auth'], function() 
{
	Route::get('logout/', ['uses' => 'AdminController@logout']);
	Route::get('/', ['uses' => 'AdminController@bike_index']);
	Route::get('bike_index', ['uses' => 'AdminController@bike_index']);
	Route::get('bike_edit/{id}', ['uses' => 'AdminController@bike_edit']);
    Route::get('bike_delete/{id}', ['uses' => 'AdminController@bike_delete']);
    Route::post('bike_update/{id}', ['uses' => 'AdminController@bike_update']);
    Route::get('bike_lost/{id}', ['users' => 'AdminController@bike_lost']);
	Route::get('user_index', ['uses' => 'AdminController@user_index']);
	Route::get('user_create', ['uses' => 'AdminController@user_create']);
	Route::get('user_delete/{id}', ['uses' => 'AdminController@user_delete']);
	Route::post('user_store', ['uses' => 'AdminController@user_store']);
	Route::get('image_resizing', ['uses' => 'AdminController@image_resizing']);
	Route::get('send_test_email_to_admin', ['uses' => 'AdminController@send_test_email_to_admin']);
	Route::post('image_resizing', ['uses' => 'AdminController@image_resizing_post']);
});

// API

Route::group(['prefix' => 'api/v1'], function() {		
	Route::get('/', function() {
		return Response::json(["status" => "error", "message" => "Nothing here. You're very close though."]);
	});
	Route::resource('bikes', 'ApiController');
});
