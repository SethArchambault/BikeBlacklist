@extends('admin._layouts.master')

@section('main')
	<div class="container">
		<br><br>
		<table class="table table-bordered">
			@foreach ($bikes as $bike)
			<tr>
				<th>id</th>
				<th>bike_uid</th>
				<th>description</th>
				<th>status</th>
				<th>photo</th>
				<th>lost_date</th>
				<th>found_date</th>
				<th>found_story</th>
				<th>email</th>
				<th></th>
                <th></th>
			</tr>
			<tr>
				<td>{{ $bike->id }}</td>
				<td>{{ $bike->bike_uid }}</td>
				<td>{{ $bike->description }}</td>
				<td>{{ $bike->status }}</td>
				<td>{{ $bike->photo }}</td>
				<td>{{ $bike->lost_date }}</td>
				<td>{{ $bike->found_date }}</td>
				<td>{{ $bike->found_story }}</td>
				<td>{{ $bike->email }}</td>
				<td><a href="/admin/bike_edit/{{ $bike->id }}">Edit</a></td>
                <td><a href="/admin/bike_delete/{{ $bike->id }}">Delete</a></td>
            </tr>
			@endforeach
			
		</table>
	</div> <!-- container -->
@stop