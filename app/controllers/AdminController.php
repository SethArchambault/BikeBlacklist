<?php

use App\Models\Bike;

class AdminController extends BaseController {
	public function index() {
		$bikes = Bike::orderby('lost_date', 'desc')->get();
		return View::make('admin.index')->with('bikes', $bikes); 
	}
	public function edit($id) {

		$bike = Bike::find($id);
		return View::make('admin.edit')->with('bike', $bike); 	
	}
    public function update($id)
    {
            $bike = Bike::find($id);
            $bike->description = Input::get('description');
            $bike->lost_date = Input::get('lost_date');
            $bike->photo = Input::get('photo');
            $bike->save();

            return Redirect::to('/admin');
    }
}