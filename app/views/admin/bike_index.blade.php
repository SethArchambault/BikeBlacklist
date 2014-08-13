@extends('admin._layouts.master')

@section('main')
	<div class="container">
		<br><br>
		<table class="table table-bordered">
			<tr>
				<th>email</th>
				<th>description</th>
				<th>location</th>
				<th></th>
				<th></th>
			</tr>
			@foreach ($bikes as $bike)
			<tr>
				<td>{{ $bike->email }}</td>
				<td>{{ $bike->description }}</td>
				<td>{{ $bike->lost_location }}</td>
				<td><a href="/bike/{{ $bike->bike_uid }}" target="_blank">View</a></td>
				<td><a href="/admin/bike_edit/{{ $bike->id }}">Edit</a></td>
            </tr>
			@endforeach
			
		</table>
	</div> <!-- container -->
@stop