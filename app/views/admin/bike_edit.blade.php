@extends('admin._layouts.master')

@section('main')
	<div class="container">
		<div class="row">
			<div class="col-xs-12" style="padding-top:50px;">				
				<form role="form" action="/admin/bike_update/{{ $bike->id }}" method="post">
					<div class="form-group">
						<label>id</label>
						{{ $bike->id }}
					</div>				
					<div class="form-group">
					<label>bike_uid</label>
					{{ $bike->bike_uid }}
					</div>				
					<div class="form-group">
						<label>description</label>
						<textarea class="form-control" name="description">{{ $bike->description }}</textarea>
					</div> <!-- /.form-group -->
					<div class="form-group">
					<label>status</label>
					{{ $bike->status }}
					</div>				
					<div class="form-group">
					<label>photo</label><br>
					{{ $bike->photo }}<br>
					<input type="checkbox" name="resave_photo_check" id="resave_photo_check"> <label for="resave_photo_check">Resave Photo</label>
					</div>				
					<div class="form-group">
						<label>lost_date</label>
						<input type="text" class="form-control" name="lost_date" value="{{ $bike->lost_date }}">
					</div>				
					<div class="form-group">
					<label>found_key</label>
					{{ $bike->found_key }}
					</div>				
					<div class="form-group">
					<label>found_date</label>
					{{ $bike->found_date }}
					</div>				
					<div class="form-group">
					<label>found_story</label>
					{{ $bike->found_story }}
					</div>				
					<div class="form-group">
					<label>email</label>
					{{ $bike->email }}
					</div>
					<div class="form-group">
						<label>serial</label>
						<input type="text" class="form-control" name="serial_num" value="{{ $bike->serial_num }}">
					</div>				
					<div class="form-group">
						<label>approximate value</label>
						<input type="text" class="form-control" name="approximate_value" value="{{ $bike->approximate_value }}">
					</div>				
				
					<hr>
					<h1>Lost</h1>
					<div class="form-group">
						<label>time range stolen</label>
						<input type="text" class="form-control" name="lost_time_range" value="{{ $bike->lost_time_range }}">
					</div> <!-- /.form-group -->
					<!-- Lost -->

					<div class="form-group">
						<label>location</label>
						<a id="geocode_js" href="#">Geocode It</a>
						<input id="lost_location" type="text" class="form-control" name="lost_location" value="{{ $bike->lost_location }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>longitude</label>
						<input type="text" class="form-control" id="lost_longitude" name="lost_longitude" value="{{ $bike->lost_longitude }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>latitude</label>
						<input type="text" class="form-control" id="lost_latitude" name="lost_latitude" value="{{ $bike->lost_latitude }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>formatted address</label>
						<input id="lost_formatted_address" type="text" class="form-control" name="lost_formatted_address" value="{{ $bike->lost_formatted_address }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>street number</label>
						<input id="lost_street_number" type="text" class="form-control" name="lost_street_number" value="{{ $bike->lost_street_number }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>postal code</label>
						<input id="lost_postal_code" type="text" class="form-control" name="lost_postal_code" value="{{ $bike->lost_postal_code }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>city</label>
						<input id="lost_city" type="text" class="form-control" name="lost_city" value="{{ $bike->lost_city }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>state</label>
						<input id="lost_state" type="text" class="form-control" name="lost_state" value="{{ $bike->lost_state }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>county</label>
						<input id="lost_county" type="text" class="form-control" name="lost_county" value="{{ $bike->lost_county }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>neighborhood</label>
						<input type="text" class="form-control" id="lost_neighborhood" name="lost_neighborhood" value="{{ $bike->lost_neighborhood }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>admin notes</label>
						<textarea class="form-control" name="lost_admin_notes"><?= $bike->admin_notes ?></textarea>	
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>Lessons Learned / Advice </label>
						<textarea class="form-control" name="lost_advice"><?= $bike->advice ?></textarea>	
					</div> <!-- /.form-group -->
					
					<hr>
					<h1>Found</h1>
					<!-- Found -->
					<div class="form-group">
						<label>found location</label>
						<input type="text" class="form-control" name="found_location" value="{{ $bike->found_location }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>found longitude</label>
						<input type="text" class="form-control" name="found_longitude" value="{{ $bike->found_longitude }}">
					</div> <!-- /.form-group -->
					<div class="form-group">
						<label>found latitude</label>
						<input type="text" class="form-control" name="found_latitude" value="{{ $bike->found_latitude }}">
					</div> <!-- /.form-group -->

					<input type="submit" value="Save" class="btn btn-primary">
				</form>
			</div>

		</div>
	</div> <!-- container -->
@stop

@section('footer')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>	


$('#geocode_js').click(function(e) {
	e.preventDefault();
	// check if lost location has input
	var address_detail_obj = {};

	var address_value = $.trim($('#lost_location').val());

	if (address_value == "") {
		console.log('Nothing entered');
		return false;
	}

	var wdwot_url = "https://stage.whydontweownthis.com/search.json?query="+encodeURI(address_value);
	$.get(wdwot_url, function(data) {
		if (typeof data.results === 'undefined') {
			console.log('data.results is undefined');
			return false;
		}
		if (data.results.length <= 0) {
			console.log('address_components array has no length');
		}
		address_detail_obj.wdwot = data.results[0];
	})
	.fail(function(data) {
		console.log("Error: Status " + data.status);
	});

    address_value = address_value + " Detroit, MI";


	var address_uri = encodeURI(address_value);
    var google_url = "https://maps.googleapis.com/maps/api/geocode/json?address="+address_uri;
	//&key=AIzaSyDl0sSvYHkf8eEhp8c8flYD6uI_81BVY8E

    $.get(google_url, function(response){
    	if (typeof response != 'object') {
    		console.log('Response is not JSON');
    		return false;
    	}
		// check if response has results
		if (typeof response.results === 'undefined') {
			console.log('response.results is undefined');
			return false;
		}

		var results_array = response.results;
		if( Object.prototype.toString.call( results_array ) !== '[object Array]' ) {
			console.log('response.results is not an Array');
			return false;
		}
		var result_first_obj = results_array[0];

		if (typeof result_first_obj.formatted_address === 'undefined') {
			console.log('result_first_obj.formatted_address is undefined');
			return false;
		}
		var formatted_address = result_first_obj.formatted_address;
		if (formatted_address == "Detroit, MI, USA") {
			console.log('not found');
			return false;
		}

		// check if geometry exists
		if (typeof result_first_obj.geometry === 'undefined') {
			console.log('result_first_obj.geometry is undefined');
			return false;
		}
		var geometry = result_first_obj.geometry;

		// check if location exists
		if (typeof geometry.location === 'undefined') {
			console.log('geometry.location is undefined');
			return false;
		}
		var location = geometry.location;

		// check if lat exists
		if (typeof location.lat === 'undefined') {
			console.log('location.lat is undefined');
			return false;
		}
		address_detail_obj.latitude = location.lat;

		// check if lat exists
		if (typeof location.lng === 'undefined') {
			console.log('location.lng is undefined');
			return false;
		}
		address_detail_obj.longitude = geometry.location.lng;
		address_detail_obj.formatted_address = formatted_address;

		// check if geometry.viewport
		if (typeof geometry.viewport === 'undefined') {
			console.log('geometry.viewport is undefined');
			return false;
		}
		address_detail_obj.google_viewport = geometry.viewport;

		if (typeof result_first_obj.address_components === 'undefined') {
			console.log('result_first_obj.address_components is undefined');
			return false;
		}
		var address_components = result_first_obj.address_components;

		if( Object.prototype.toString.call( address_components ) !== '[object Array]' ) {
			console.log('address_components is not an Array');
			return false;
		}

		var type;
		if (address_components.length <= 0) {
			console.log('address_components array has no length');
		}
		for (var n = 0; n < address_components.length; n++) {
			if (address_components[n].types.length <= 0) {
				console.log('address_components['+n+'].types array has no length');
			}
			for (var i = 0; i < address_components[n].types.length; i++) {
				type = address_components[n].types[i];
				if (type == 'street_number')
					address_detail_obj.street_number = address_components[n].short_name;
				if (type == 'neighborhood')
					address_detail_obj.neighborhood = address_components[n].short_name;
				if (type == 'locality') // find city
					address_detail_obj.city = address_components[n].short_name;
				if (type == 'administrative_area_level_1') // find state
					address_detail_obj.state = address_components[n].short_name;
				if (type == 'administrative_area_level_2') // find county
					address_detail_obj.county = address_components[n].short_name;
				if (type == 'postal_code')
					address_detail_obj.postal_code = address_components[n].short_name;
				if (type == 'country')
					address_detail_obj.country = address_components[n].short_name;
			}
		}
		console.log(address_detail_obj);


		$('#lost_latitude').val(address_detail_obj.latitude);
		$('#lost_longitude').val(address_detail_obj.longitude);
		$('#lost_formatted_address').val(address_detail_obj.formatted_address);
		$('#lost_postal_code').val(address_detail_obj.postal_code);
		$('#lost_street_number').val(address_detail_obj.street_number);
		$('#lost_state').val(address_detail_obj.state);
		$('#lost_city').val(address_detail_obj.city);
		$('#lost_county').val(address_detail_obj.county);
		$('#lost_neighborhood').val(address_detail_obj.neighborhood);

    })
	.fail(function(data) {
		console.log("Error: Status " + data.status);
		return false;
	});
});



</script>
@stop
