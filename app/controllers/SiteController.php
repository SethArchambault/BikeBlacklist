<?php namespace App\Controllers;

use App;
use App\Models\Bike;
use Helper\Helper;
use Input, Redirect, Config, View;
use Illuminate\Queue\Queue;
use Mail;
use Log;
use Whoops\Example\Exception;
use Session;
use Validator;

class SiteController extends \BaseController {

    /* HOME */

    public function bikes()
    {
            return View::make('site.bikes')
                ->with('bikes', Bike::orderby('lost_date', 'desc')->where('status', '<', 2)->orderBy('created_at', 'desc')->limit(40)->get());
    }

    /* BIKE */

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

    public function print_bike($bike_uid)
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

            return View::make('site.print')->with(['bike' => $bike, 'date_format' => $date_format]);
    }

    /* ADDING FIELDS */

    public function my_bike_is_missing()
    {
        

        return View::make('site.my_bike_is_missing')->with([
            'description'   => Input::old('description'),
            'lost_date'     => Input::old('lost_date') ? Input::old('lost_date') : date('m/d/Y'),
            'email'         => Input::old('email'),
            'lost_location' => Input::old('lost_location'),
            'photo'         => Input::old('subfile')
        ]);
    }

    public function more_details()
    {
        // if in dev mode, set bike_id session
        if (Config::get('app.dev_mode')) {
            Session::set('bike_id', 51);
        }

        if ( !Session::has('bike_id')) {
            Log::error("SiteController - function more_details - bike_id was not found in session");
            return Redirect::to('/')->with('message', "Your bike has been submitted, but something went wrong - I'll look into it.");
        }

        return View::make('site.more_details');
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
        // get input
        $description = Input::get('description');
        $lost_date = Input::get('lost_date'); 
        $email = Input::get('email');
        $lost_location = Input::get('lost_location');
        $photo_file = Input::file('photo');

        // validate
        $validator = Validator::make(
            [
                'description'   => $description,
                'date'     => $lost_date,
                'email'         => $email,
                'location' => $lost_location,
                'photo'         => $photo_file
            ],
            [
                'description'   => ['required', 'max:140'],
                'date'     => ['required', 'date'],
                'email'         => ['required', 'email'],
                'location' => ['required'],
                'photo'         => ['required', 'image']
            ]
        );
        if ($validator->fails()) {
            return Redirect::to('/my-bike-is-missing')->withErrors($validator)->withInput();
        } 


        $photo_filename = Helper::SaveBikePhoto($photo_file, Config::get('app.file_dir'));
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
        $bike->lost_location = $lost_location;
        $bike->found_key = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
        $bike->save();

        
        // send welcome email

        $data['bike_owner_email'] = $bike->email;
        $data['url'] = $_SERVER['SERVER_NAME'] . "/bike/". $bike->bike_uid;
        $data['admin_url'] = $_SERVER['SERVER_NAME'] . "/admin/bike_edit/" . $bike->id;

        // check if this is being run locally
        if (Config::get('app.send_email')) {

            // send message to bike owner
            Mail::send('emails.hello', $data, function($message) use ($data)
            {
                    $message->to($data['bike_owner_email'])->subject('Sadface');
            });

            // send message to admin
            Mail::send('emails.hello_admin', $data, function($message)
            {
                    $message->to('hellofriend@detroitbikeblacklist.com', 'Seth Archambault')->subject('Sorry about your bike');
            });
        }


        if (!is_int($bike->id)) {
            Log::error("bike->id is not int - it is ". $bike->id . " something is wrong, probably not saved correctly");
            return Redirect::to('/bike/' . $bike->bike_uid)->with('message', "Thanks for reporting your bike! Check your email for next steps.");
        }

        Session::put('bike_id', $bike->id);

        return Redirect::to('/more-details')->with('message', "Your bike has been reported!<br>Check your email for next steps. Thanks!");

    }

    public function store_more_details()
    {
                // input
        $bike_placement = Input::get('bike_placement');
        $lock_method = Input::get('lock_method');
        $lock_type = Input::get('lock_type');
        $theft_desc = Input::get('theft_desc');
        $serial_num = Input::get('serial_num');
        $advice = Input::get('advice');
        // build unique id

        // check to see if this unique Id exists
        if (!Session::has('bike_id')) {
            Log::error("SiteController - function more_details - bike_id was not found in session");
            return Redirect::to('/')->with('message', "Your bike has been submitted, but something went wrong.");
        }
        $bike_id = Session::get('bike_id');
        // find bike based on session bike id
        $bike = Bike::find($bike_id);
        $bike->bike_placement = $bike_placement;
        $bike->lock_method = $lock_method;
        $bike->lock_type = $lock_type;
        $bike->theft_desc = $theft_desc;
        $bike->advice = $advice;
        $bike->serial_num = $serial_num;
        $bike->save();
        
        return Redirect::to('/')->with('message', "Great! These extra details have been saved. Thanks for taking the time.");

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

        $message = Input::get('message');
        $email = Input::get('email');

        // validate
        $validator = Validator::make(
            [
                'message'   => $message,
                'email'     => $email
            ],
            [
                'message'   => ['required'],
                'email'         => ['required', 'email']
            ]
        );
        if ($validator->fails()) {
            return Redirect::to('/feedback#contact-me')->withErrors($validator)->withInput();
        } 

        $data['message_to_me'] = $message; 
        $data['email'] = $email;
        $data['useragent'] = $_SERVER['HTTP_USER_AGENT'];
        if (Config::get('app.send_email')) {
            Mail::send('emails.feedback', $data, function($message)
            {
                    $message->to('feedback@detroitbikeblacklist.com', 'Feedback Detroit Bike Blacklist')->subject('Feedback for the Blikelist!');
            });
        } else {
            // debug only
            return View::make('emails.feedback')->with($data); 
        }

            return Redirect::route('site.bikes')->with('message', 'Message Sent! Thanks!');
    }
    public function about() {
        return View::make('site.about');
    }

}