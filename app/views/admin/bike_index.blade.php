@extends('admin._layouts.master')

@section('main')
	<div class="container">
		<br><br>
		<table class="table table-bordered">
			<tr>
				<th>id</th>
				<th>bike_uid</th>
				<th>description</th>
				<th>status</th>
				<th>lost_date</th>
				<th>email</th>
				<th></th>
			</tr>
			@foreach ($bikes as $bike)
			<tr>
				<td>{{ $bike->id }}</td>
				<td>{{ $bike->bike_uid }}</td>
				<td>{{ $bike->description }}</td>
				<td>{{ $bike->status }}</td>
				<td>{{ $bike->lost_date }}</td>
				<td>{{ $bike->email }}</td>
				<td><a href="/admin/bike_edit/{{ $bike->id }}">Edit</a></td>
            </tr>
			@endforeach
			
		</table>
	</div> <!-- container -->
@stop