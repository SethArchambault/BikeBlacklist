<?php namespace App\Controllers;
 
use App\Models\Bike;
use Input, Redirect, Config, View;
use Intervention\Image\Image;
use Illuminate\Queue\Queue;
use Mail;

class SiteController extends \BaseController {
 
        public function bikes()
        {
                return View::make('site.bikes')->with('bikes', Bike::all());
        }

        public function bike($bike_id)
        {
                return View::make('site.bike')->with('bike', Bike::find($bike_id));
        }

        public function my_bike_is_missing()
        {
                return View::make('site.my_bike_is_missing');
        }

        public function resize_photo()
        {
                return View::make('site.my_bike_is_missing');
        }

        public function delete($bike_id)
        {
                Bike::find($bike_id)->delete();
                return Redirect::route('site.bikes')->with('message', 'Bike Deleted!');
        }


        public function store()
        {
                $file = Input::file('photo');
                $filename = $file->getClientOriginalName();
                $file_path = "/" . $file->move(Config::get('app.file_dir'), date("Y-m-d_H-i_") . $filename);

                $bike = new Bike;
                $bike->description = Input::get('description');
                $bike->lost_date = date('Y-m-d', strtotime(Input::get('lost_date')));
                $bike->photo = $file_path;
                $bike->email = Input::get('email');
                $bike->save();
 
                return Redirect::route('site.bike')->with('message', 'Bike Saved!');
        }

        public function email() 
        {
                Mail::send('emails.found_bike', ['content', Input::get('content')], function($message)
                {
                        $message->to('spam@seth.doercreator.com', 'Seth Archambault')->subject('Found your bike Seth!');
                });
        
                return Redirect::route('site.bikes')->with('message', 'Email Sent!');
        }

        public function feedback() 
        {
                Mail::send('emails.feedback', ['content', Input::get('content')], function($message)
                {
                        $message->to('blikelist@seth.doercreator.com', 'Seth Archambault')->subject('Feedback for the Blikelist!');
                });
        
                return Redirect::route('site.bikes')->with('message', 'Email Sent!');
        }
 
}