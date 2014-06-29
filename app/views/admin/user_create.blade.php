@extends('admin._layouts.master')

@section('main')
	<div class="container">
		<br><br>
		<form action="/admin/user_store" method="post">
					
		firstname <input name="firstname"><br>
		lastname <input name="lastname"><br>
		email <input name="email"><br>
		password <input name="password"><br>
		<input class="btn" type="submit" value="save">
		</form>

	</div> <!-- container -->
@stop