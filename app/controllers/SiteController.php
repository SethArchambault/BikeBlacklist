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
                // need bike id
                $bike = Bike::find(Input::get('bike_id'));
                $bike_id = $bike->id;
                $data['bike_owner_email'] = $bike->email;
                $data['content'] = Input::get('content');

                // send message to bike owner
                Mail::send('emails.found_bike', $data, function($message) use ($data)
                {
                        $message->to($data['bike_owner_email'])->subject('Found your bike!');
                });

                // send message to admin
                Mail::send('emails.found_bike_admin', $data, function($message)
                {
                        $message->to('detroitbikeblacklist@seth.doercreator.com', 'Seth Archambault')->subject('Blikelist - Found Bike');
                });

                // send message to bike owner
        
                return Redirect::route('site.bikes')->with('message', 'Email Sent! An email has been sent to the rightful owner of the bike - thanks so much!');
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