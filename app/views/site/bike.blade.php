@extends('site._layouts.master')

@section('main')

	<div class="container">

		@include('site._partials.flash_message')

		<div class="col-sm-6">
			<h1>{{ $bike->lost_date }}</h1>
			<p>{{ $bike->description }}</p>
	      	<div style="padding-bottom:10px;"><img src="{{ $bike->photo }}"></div>
		    <a href="#">Report this image</a>
		</div>
		<div class="col-sm-6">
		    <h3>Share this Link</h3>
		    <div>http://detroitbikeblacklist.com/bike/{{ $bike->id }}</div>
		    <a href="#">Copy Link </a>
		    
		    <h3>Admin Controls</h3>
		    <a href="/delete/{{ $bike->id }}">Delete Bike </a>
		    <p><a href="#" class="btn btn-primary btn-lg" data-dismiss="modal" data-toggle="modal" data-target="#foundItModal" role="button">I Found It!</a> </p>

			
		</div>
	
	</div>

	@include('site._partials.foundit_modal')

@stop
