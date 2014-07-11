@extends('site._layouts.master')

@section('header')
<link rel="stylesheet" type="text/css" href="/bike_style.css">

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

			<div class="col-sm-5">
                <h1>MISSING BIKE</h1>
                <div id="bike-date">{{ date($date_format, strtotime($bike->lost_date)) }}</div>
				<div id="bike-description">{{ $bike->description }}</div>
		      	<div style="padding-bottom:10px;"></div>
                <a href="#" class="btn-found-it text-center" data-dismiss="modal" data-toggle="modal" data-target="#foundItModal" role="button">I FOUND IT</a>

			</div>
			<div class="col-sm-7">
                <img id="bike-image" class="img-responsive" src="/uploads/large/{{ $bike->photo }}">
            </div>
		</div> <!-- /.row -->
    </div> <!-- /.container -->
    <div id="div-share-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div id="text-help-find">
                        Help Find This Bike
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="div-share">
                        Share this link with everyone you know:<br>
                        http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.div-share-bar -->


	@include('site._partials.foundit_modal')

@stop
