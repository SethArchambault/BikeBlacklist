<?php namespace App\Controllers\Admin;
 
use App\Models\Bike;
use Input, Redirect, Sentry, Str;
 
class BikesController extends \BaseController {
 
        public function index()
        {
                return \View::make('admin.bikes.index')->with('bikes', Bike::all());
        }
 
        public function show($id)
        {
                return \View::make('admin.bikes.show')->with('bike', Bike::find($id));
        }
 
        public function create()
        {
                return \View::make('admin.bikes.create');
        }
 
        public function store()
        {
                $bike = Bike::find($id);
 
                return Redirect::route('admin.bikes.edit', $bike->id);

                $bike = new Bike;
                $bike->description = Input::get('description');
                $bike->lost_date = Input::get('lost_date');
                $bike->photo = Input::get('photo');
                $bike->save();
 
                return Redirect::route('admin.bikes.index');
        }
 
        public function edit($id)
        {
                return \View::make('admin.bikes.edit')->with('bike', Bike::find($id));
        }
 
        public function update($id)
        {
                $bike = Bike::find($id);
                $bike->description = Input::get('description');
                $bike->lost_date = Input::get('lost_date');
                $bike->photo = Input::get('photo');
                $bike->save();
 
                return Redirect::route('admin.bikes.index');
        }
 
        public function destroy($id)
        {
                $bike = Bike::find($id);
                $bike->delete();
 
                return Redirect::route('admin.bikes.index');
        }
 
}