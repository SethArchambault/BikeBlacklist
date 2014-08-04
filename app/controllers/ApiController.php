<?php

use App\Models\Bike;

class ApiController extends BaseController {

	public function index() {
		$all_bikes = Bike::all([
			'id', 'bike_uid', 'description', 'photo', 'lost_date', 'created_at']);

		return Response::json([
			'status' => 'ok',
			'results' => $all_bikes
			]);
	}

	public function show($id) {
		$bike_row = Bike::find($id, 
			['id', 'bike_uid', 'description', 'photo', 'lost_date', 'created_at']);

		return Response::json([
			'status' => 'ok',
			'results' => $bike_row
			]);
	}
}