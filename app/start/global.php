<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function($exception) {
    Log::error($exception);

    if (Config::get('app.raven_errors')) {
		$client = new Raven_Client('https://f2594dc21e874fe386e734b507b22e3f:ab7d5a5d205b477ba3c50dd40669d9b6@app.getsentry.com/28709');
		// Capture a message
		$event_id = $client->getIdent($client->captureMessage($exception));
		if ($client->getLastError() !== null) {
		    Log::error('There was an error sending the event to Sentry: %s', $client->getLastError());
		}	    	
    }

    return Response::view('errors.missing', array(), 404);
});

App::missing(function($exception)
{
    Log::error($exception);

    if (Config::get('app.raven_errors')) {
		$client = new Raven_Client('https://f2594dc21e874fe386e734b507b22e3f:ab7d5a5d205b477ba3c50dd40669d9b6@app.getsentry.com/28709');
		// Capture a message
		$event_id = $client->getIdent($client->captureMessage($exception));
		if ($client->getLastError() !== null) {
		    Log::error('There was an error sending the event to Sentry: %s', $client->getLastError());
		}	    	
    }

    return Response::view('errors.missing', array(), 404);
});


/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
