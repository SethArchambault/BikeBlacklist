<?php

use App\Models\Bike;
use Helper\Helper;


class AdminController extends BaseController {

    public function login() {
        return View::make('admin.login');   
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }

    public function check_login() {
        // see if there is a user with this email
        // if not flash error back to the login screen
        if (Auth::attempt([
            'email' => Input::get('email'), 
            'password' => Input::get('password')], true))
        {
            return Redirect::intended('admin/bike_index');
        }
        return Redirect::to('login')->with('message', 'Check login failed');
    
    }

	public function bike_index() {
        $send_email = Config::get('app.send_email');
		$bikes = Bike::orderby('created_at', 'desc')->get();
		return View::make('admin.bike_index')->with(['bikes' => $bikes, 'total_bike_num' => count($bikes), 'send_email' => $send_email]); 
	}
	public function bike_edit($id) {

		$bike = Bike::find($id);
		return View::make('admin.bike_edit')->with('bike', $bike); 	
	}
    public function bike_update($id)
    {
        $bike = Bike::find($id);
        $bike->description = Input::get('description');
        $bike->lost_date = Input::get('lost_date');
        $bike->advice = Input::get('advice');
        $bike->admin_notes = Input::get('admin_notes');
        $bike->lost_time = strtotime(Input::get('lost_time_range'));
        $bike->lost_neighborhood = Input::get('lost_neighborhood');
        $bike->lost_county = Input::get('lost_county');
        $bike->lost_state = Input::get('lost_state');
        $bike->lost_city = Input::get('lost_city');
        $bike->lost_postal_code = Input::get('lost_postal_code');
        $bike->lost_street_number = Input::get('lost_street_number');
        $bike->lost_formatted_address = Input::get('lost_formatted_address');
        $bike->lost_latitude = Input::get('lost_latitude');
        $bike->lost_longitude = Input::get('lost_longitude');
        $bike->lost_location = Input::get('lost_location');
        $bike->serial_num = Input::get('serial_num');
        $bike->approx_value = Input::get('approx_value');
        $bike->bike_placement = Input::get('bike_placement');
        $bike->lock_type = Input::get('lock_type');
        $bike->lock_method = Input::get('lock_method');
        $bike->theft_desc = Input::get('theft_desc');

        $resave_photo = Input::get('resave_photo_check');
        if ($resave_photo == "on") {
            $bike->photo = Helper::SaveBikePhoto(Input::file('photo'), Config::get('app.file_dir'));

        }
        $bike->save();

        return Redirect::to('/admin/bike_index')->with('message', 'Bike saved');
    }

    public function bike_delete($id)
    {
        $bike = Bike::find($id);
        // TODO check to see if bike exists
/*        File::delete('uploads/large/'.$bike->photo);
        File::delete('uploads/thumb/'.$bike->photo);
        File::delete('uploads/original/'.$bike->photo);*/
        $bike->delete();

        return Redirect::to('/admin/bike_index')->with('message', 'Bike deleted');
    }

    public function lost($bike_id)
    {
        $bike = Bike::find($bike_id);
        $bike->status = 0;
        $bike->save();
        return Redirect::to('/admin/bike_index')->with('message', 'Bike Lost!');
    }

    public function user_index()
    {
        $users = User::all();
        return View::make('admin.user_index')->with('users', $users);
    }

    public function user_add()
    {
        $user_array = [
            "firstname" => Input::get("firstname"),
            "lastname" => Input::get("lastname"),
            "email" => Input::get("email"),
            "password" => Input::get("password"),
        ];
        User::insert($user_array);
    }

    public function user_delete($user_id)
    {
        User::find($user_id)->delete();

        return Redirect::to('/admin/user_index')->with('message', 'user deleted');
    }

    public function user_create()
    {
        return View::make('admin.user_create');
    }

    public function user_store()
    {
        $user = new User;

        $user->firstname = Input::get('firstname');
        $user->lastname = Input::get('lastname');
        $user->email = Input::get('email');
        $user->password =  Hash::make(Input::get('password'));

        $user->save();
        
        return Redirect::to('/admin/user_index')->with('message', 'User created');

    }

    public function image_resizing()
    {
        return View::make('admin.image_resizing');
    }
    public function image_resizing_post()
    {
        $data['photo'] = Helper::SaveBikePhoto(Input::file('photo'), Config::get('app.file_dir'));
        return View::make('admin.image_resizing', ['data' => $data]);
    }

    public function send_test_email_to_admin()
    {

            $data['bike_owner_email'] = "test@test.com";
            $data['url'] = "http://detroitbikeblacklist.com/bike/1974-schwinn-le";

            // send message to admin
            Mail::send('emails.hello_admin', $data, function($message)
            {
                    $message->to('hellofriend@detroitbikeblacklist.com', 'Seth Archambault')->subject('Sorry about your bike');
            });
            return Redirect::to('/admin/user_index')->with('message', 'Test email sent to admin');
    }
}