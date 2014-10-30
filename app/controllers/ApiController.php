<?php

use App\Models\Bike;
use Helper\Helper;


class ApiController extends BaseController {

	public function index() {
		$all_bikes = Bike::all([
			'id', 'bike_uid', 'description', 'photo', 'lost_date', 'lost_latitude', 'lost_longitude', 'advice', 'created_at']);



		return Response::json([
			'status' => 'ok',
			'results' => $all_bikes
			]);
	}

	public function geoJson() {
		$all_bikes = Bike::where(
			function($query) {
				$query->where('lost_latitude', '!=', 0);
				//->where('advice', '!=', '')
			})->get([
			'id', 'bike_uid', 'description', 'photo', 'lost_date', 'lost_latitude', 'lost_longitude', 'advice', 'theft_desc', 'created_at']);


		return Response::json(Helper::GeoJson($all_bikes), 200, ['Access-Control-Allow-Origin' => '*']);
	}

	public function show($id) {
		$bike_row = Bike::find($id, 
			['id', 'bike_uid', 'description', 'photo', 'lost_date', 'lost_latitude', 'lost_longitude', 'advice', 'created_at']);

		return Response::json([
			'status' => 'ok',
			'results' => $bike_row
			]);
	}
}