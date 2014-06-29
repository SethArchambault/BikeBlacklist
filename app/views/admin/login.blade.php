@extends('admin._layouts.master')

@section('main')
	<div class="container">
		<div>
		<? if (isset($message)): ?>
			{{ $message }}
		<? endif; ?>
		</div>
		<form method="post" action="/admin/check_login">
			Email <br>
			<input name="email" type="text"><br><br>

			Password <br>
			<input name="password" type="password"><br><br>

			<input type="submit">			
		</form>
	</div>
@stop