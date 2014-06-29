@extends('site._layouts.master')

@section('header')
<!-- for Google -->
<meta name="description" content="{{ $bike->description }}" />
<meta name="keywords" content="detroit, mssing, stolen, bike, bicycle" />

<meta name="author" content="Blikelist" />
<meta name="copyright" content="2014" />
<meta name="application-name" content="Blikelist" />

<!-- for Facebook -->          
<meta property="og:title" content="Missing Bike" />
<meta property="og:type" content="article" />
<meta property="og:image" content="{{ $bike->photo }}" />
<meta property="og:url" content="http://blikelist.com/{{ $bike->bike_uid }}" />
<meta property="og:description" content="{{ $bike->description }}" />

<!-- for Twitter -->          
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="Missing Bike - {{ $bike->description }}" />
<meta name="twitter:description" content="{{ $bike->description }}" />
<meta name="twitter:image" content="{{ $bike->photo }}" />
@stop

@section('main')

	<div class="container">

		@include('site._partials.flash_message')
		<div class="row">
			

			<div class="col-sm-8">
				<h1>{{ date($date_format, strtotime($bike->lost_date)) }}</h1>
				<p>{{ $bike->description }}</p>
		      	<div style="padding-bottom:10px;"><img src="/uploads/large/{{ $bike->photo }}" width="100%"></div>
			    <a href="#">Report this image</a>
			</div>
			<div class="col-sm-4">
                <p>Share this link</p>
                <div>http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}</div>
			    <p><a href="#" class="btn btn-primary btn-lg" data-dismiss="modal" data-toggle="modal" data-target="#foundItModal" role="button">I Found It!</a> </p>

				
			</div>
		</div>
	</div>

	@include('site._partials.foundit_modal')

@stop
