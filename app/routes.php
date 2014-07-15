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
Route::post('/email', ['as' => 'site.email', 'uses' => 'App\Controllers\SiteController@email']);
Route::get('/feedback', ['as' => 'site.feedback', 'uses' => 'App\Controllers\SiteController@feedback']);
Route::post('/mail_feedback', ['as' => 'site.mail_feedback', 'uses' => 'App\Controllers\SiteController@mail_feedback']);

Route::get('/my-bike-is-missing', array('as' => 'site.my_bike_is_missing', 'uses' => 'App\Controllers\SiteController@my_bike_is_missing'));
Route::post('/store', array('as' => 'site.store', 'uses' => 'App\Controllers\SiteController@store'));

Route::get('/login/', ['before' => '', 'uses' => 'AdminController@login']);

Route::group(['prefix' => 'admin', 'before' => 'auth'], function() 
{
	Route::get('logout/', ['uses' => 'AdminController@logout']);
	Route::post('check_login', ['uses' => 'AdminController@check_login']);
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
	Route::post('image_resizing', ['uses' => 'AdminController@image_resizing_post']);
});
