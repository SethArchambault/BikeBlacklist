<?php namespace App\Controllers;
 
use App\Models\Bike;
use Helper\Helper;
use Input, Redirect, Config, View;
use Illuminate\Queue\Queue;
use Mail;
use Log;
use Whoops\Example\Exception;

class SiteController extends \BaseController {

        public function bikes()
        {
                return View::make('site.bikes')
                    ->with('bikes', Bike::orderby('lost_date', 'desc')->orderBy('created_at', 'desc')->get());
        }

        public function bike($bike_uid)
        {
                $bikes_with_uid = Bike::where("bike_uid", $bike_uid);
                if ($bikes_with_uid->count() > 1)
                {
                        Log::warning("SiteController - function bike - Multiple bikes with bike_uid '$bike_uid'. Picking the first one :(");
                }
                elseif(!$bikes_with_uid->exists())
                {
                        Log::error("SiteController - function bike - No bike with bike_uid '$bike_uid'. This is a problem!");
                        return Redirect::route('site.bikes')->with('message', "Can't find that bike! Seth will figure out what is wrong.");
                }

                $bike = $bikes_with_uid->first();
                $date_format = 'l, F jS, Y';

                if (date('Y', strtotime($bike->lost_date)) == date('Y')) {
                        $date_format = 'l, F jS';
                }

                return View::make('site.bike')->with(['bike' => $bike, 'date_format' => $date_format]);
        }

        public function my_bike_is_missing()
        {
                return View::make('site.my_bike_is_missing')->with('todays_date', date('m/d/Y'));
        }



        public function resize_photo()
        {
                return View::make('site.my_bike_is_missing');
        }

        public function found($found_key)
        {
                $bike = Bike::where('found_key', $found_key)->first();
                if ($bike->exists())
                {
                        $bike->status = 1;
                        $bike->save();
                        return Redirect::route('site.bikes')->with('message', 'Bike Found!');                
                }
                Log::warning("SiteController.php - function found() - Bike with found_key '$found_key' could not be found");
                // Report error to Seth
                return Redirect::route('site.bikes')->with('message', "Couldn't find that bike. Seth will look into this.");                
        }



        public function store()
        {


            // input
            $description = Input::get('description');
            $lost_date = Input::get('lost_date');
            $email = Input::get('email');
            $photo_filename = Helper::SaveBikePhoto(Input::file('photo'), Config::get('app.file_dir'));
            // build unique id

            $desc_words= explode(" ", $description, 4);
            $bike_uid = implode("-", array_splice($desc_words, 0, 3));
            $bike_uid = preg_replace('/[^A-Za-z0-9\-]/', '', $bike_uid);
            $bike_uid = strtolower($bike_uid);

            // check to see if this unique Id exists
            if (Bike::where('bike_uid', $bike_uid)->exists())
            {
                // add date
                Log::info("SiteController.php - function store() - Bike with bike_uid '$bike_uid' already exists, we've got to create a unique by adding more info");
                $bike_uid .= date('-m-d', strtotime($lost_date));
                while (Bike::where('bike_uid', $bike_uid)->exists())
                {
                        Log::info("SiteController.php - function store() - Bike with bike_uid '$bike_uid' already exists, we've got to create a unique id with a random string then.");
                        $bike_uid = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1,8);
                }
                Log::info("SiteController.php - function store() - Successfully created bike_uid '$bike_uid'");
            }

            $bike = new Bike;
            $bike->description = $description;
            $bike->lost_date = date('Y-m-d', strtotime($lost_date));
            $bike->photo = $photo_filename;
            $bike->email = $email;
            $bike->status = 0;
            $bike->bike_uid = $bike_uid;
            $bike->found_key = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
            $bike->save();

            // send welcome email

            $data['bike_owner_email'] = $bike->email;
            $data['url'] = "http://detroitbikeblacklist.com/bike/". $bike->bike_uid;

            // send message to bike owner
            Mail::send('emails.hello', $data, function($message) use ($data)
            {
                    $message->to($data['bike_owner_email'])->subject('Sadface');
            });

            // send message to admin
            Mail::send('emails.hello_admin', $data, function($message)
            {
                    $message->to('hellofriend@detroitbikeblacklist.com', 'Seth Archambault')->subject('Blikelist - Missing Bike Reported');
            });

            return Redirect::to('/bike/' . $bike->bike_uid)->with('message', "Thanks for reporting your bike! Check your email for next steps.");
        }

        public function bike_stored()
        {
            return View::make('site.bike_stored');
        }

        public function email() 
        {
                $bike_uid = Input::get('bike_uid');
                $bikes_with_uid = Bike::where("bike_uid", $bike_uid);
                if ($bikes_with_uid->count() > 1)
                {
                        Log::warning("Multiple bikes with bike_uid '$bike_uid'. Emailing the first one :(");
                }
                elseif (!$bikes_with_uid->exists())
                {
                        Log::error("No bikes with bike_uid '$bike_uid'. Something is wrong.");
                        return Redirect::route('site.bikes')->with('message', "Can't find that bike! Seth will figure out what is wrong.");
                }

                $bike = $bikes_with_uid->first();
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
                        $message->to('hellofriend@detroitbikeblacklist.com', 'Seth Archambault')->subject('Blikelist - Found Bike');
                });

                // send message to bike owner
        
                return Redirect::route('site.bikes')->with('message', 'Email Sent! An email has been sent to the rightful owner of the bike - thanks so much!');
        }



        public function feedback() {
            return View::make('site.feedback');
        }

        public function mail_feedback()
        {

            $input_message = Input::get('message');
            $data['content'] = $input_message;
                Mail::send('emails.feedback', $data, function($message)
                {
                        $message->to('feedback@detroitbikeblacklist.com', 'Feedback Detroit Bike Blacklist')->subject('Feedback for the Blikelist!');
                });

                return Redirect::route('site.bikes')->with('message', 'Message Sent! Thanks!');
        }
        public function about() {
            return View::make('site.about');
        }
 
}