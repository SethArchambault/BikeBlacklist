@extends('admin._layouts.master')

@section('main')
	<div class="container">
		<br><br>
		<a href="/admin/user_create">Create User</a>
		@if (count($users) == 0)
		<br>No users
		@endif
		<table class="table table-bordered">
			@foreach ($users as $user)
			<tr>
				<th>id</th>
				<th>firstname</th>
				<th>lastname</th>
				<th>email</th>
				<th>password</th>
				<th></th>
			</tr>
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->firstname }}</td>
				<td>{{ $user->lastname }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->password }}</td>
				<td><a href="/admin/user_delete/{{ $user->id }}">Delete</a></td>
			</tr>
			@endforeach
			
		</table>
	</div> <!-- container -->
@stop