@extends('admin._layouts.master')

@section('main')
	<div class="container">
		@include('site._partials.flash_message')

		<br><br>
		<div class="text-center" style="padding-bottom:15px;">{{ $total_bike_num }} Bikes</div>
		<div class="text-center" style="padding-bottom:15px;">send_email = {{ var_dump($send_email) }}
		</div>

		<table class="table table-bordered">
			<tr>
				<th>email</th>
				<th>advice</th>
				<th>serial_num</th>
				<th>location</th>
				<th>longitude</th>
				<th></th>
				<th></th>
			</tr>
			@foreach ($bikes as $bike)
			<tr>
				<td>{{ $bike->email }}</td>
				<td>{{ $bike->advice }}</td>
				<td>{{ $bike->serial_num }}</td>
				<td>{{ $bike->lost_location }}</td>
				<td>{{ $bike->lost_longitude }}</td>
				<td><a href="/bike/{{ $bike->bike_uid }}" target="_blank">View</a></td>
				<td><a href="/admin/bike_edit/{{ $bike->id }}">Edit</a></td>
            </tr>
			@endforeach
			
		</table>
	</div> <!-- container -->
@stop