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


Route::get('/', array('as' => 'site.bikes', 'uses' => 'App\Controllers\SiteController@bikes'));
Route::get('/delete/{bike_id}', array('as' => 'site.delete', 'uses' => 'App\Controllers\SiteController@delete'));
Route::get('/bike/{bike_id}', array('as' => 'site.bike', 'uses' => 'App\Controllers\SiteController@bike'));
Route::post('/email', ['as' => 'site.email', 'uses' => 'App\Controllers\SiteController@email']);
Route::post('/feedback', ['as' => 'site.feedback', 'uses' => 'App\Controllers\SiteController@feedback']);

Route::get('/my-bike-is-missing', array('as' => 'site.my_bike_is_missing', 'uses' => 'App\Controllers\SiteController@my_bike_is_missing'));
Route::post('/store', array('as' => 'site.store', 'uses' => 'App\Controllers\SiteController@store'));


Route::get('admin/logout', array('as' => 'admin.logout', 'uses' => 'App\Controllers\Admin\AuthController@getLogout'));
Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'App\Controllers\Admin\AuthController@getLogin'));
Route::post('admin/login', array('as' => 'admin.login.post', 'uses' => 'App\Controllers\Admin\AuthController@postLogin'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
        Route::any('/', 'App\Controllers\Admin\BikesController@index');
        Route::resource('articles', 'App\Controllers\Admin\ArticlesController');
        Route::resource('bikes', 'App\Controllers\Admin\BikesController');
});