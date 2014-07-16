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
		$bikes = Bike::orderby('lost_date', 'desc')->get();
		return View::make('admin.bike_index')->with('bikes', $bikes); 
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
            $bike->photo = Input::get('photo');
            $bike->save();

        return Redirect::to('/admin/bike_index');
    }

    public function bike_delete($id)
    {
        $bike = Bike::find($id);
        // TODO check to see if bike exists
        File::delete('uploads/large/'.$bike->photo);
        File::delete('uploads/thumb/'.$bike->photo);
        File::delete('uploads/original/'.$bike->photo);

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
}