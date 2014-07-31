@extends('site._layouts.master')

@section('title')
<title>Help Me Find My Bike - {{ $bike->description }} - Detroit Bike Blacklist</title>
@stop

@section('header')
<link rel="stylesheet" type="text/css" href="/bike_style.css">

<!-- for Google -->
<meta name="description" content="{{ preg_replace('/[^A-Za-z0-9\- ]/', '', $bike->description) }}" />
<meta name="keywords" content="detroit, mssing, stolen, bike, bicycle" />

<meta name="author" content="Blikelist" />
<meta name="copyright" content="2014" />
<meta name="application-name" content="Blikelist" />

<!-- for Facebook -->          
<meta property="og:title" content="My Bike is Missing" />
<meta property="og:type" content="article" />
<meta property="og:image" content="{{ $bike->photo }}" />
<meta property="og:url" content="http://blikelist.com/{{ $bike->bike_uid }}" />
<meta property="og:description" content="{{ preg_replace('/[^A-Za-z0-9\- ]/', '', $bike->description) }}" />

<!-- for Twitter -->          
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="My Bike is Missing" />
<meta name="twitter:description" content="{{ preg_replace('/[^A-Za-z0-9\- ]/', '', $bike->description) }}" />
<meta name="twitter:image" content="{{ $bike->photo }}" />
@stop

@section('main')

	<div class="container" id="main">

		@include('site._partials.flash_message')
		<div class="row" style="padding-top:10px;">

			<div class="col-sm-5">
                <h1>MISSING BIKE</h1>
                <div id="bike-date">{{ date($date_format, strtotime($bike->lost_date)) }}</div>
				<div id="bike-description">{{ $bike->description }}</div>
		      	<div style="padding-bottom:10px;"></div>
                <a href="#" class="btn-found-it foundItButtonJS text-center" data-dismiss="modal" data-toggle="modal" data-target="#foundItModal" data-bike-uid="{{ $bike->bike_uid }}" role="button">I FOUND IT</a>

			</div>
			<div class="col-sm-7">
                <img id="bike-image" class="img-responsive" src="/uploads/large/{{ $bike->photo }}">
            </div>
		</div> <!-- /.row -->
    </div> <!-- /.container -->
    <div id="div-share-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="text-help-find">
                        Help Find This Bike
                    </div>
                    <div id="div-share">
                        <p>Share this link with everyone you know:</p>
                        <div class="row">
                            <div class="col-sm-7 col-xs-12" style="padding-bottom:15px;">
                                <input type="text" id="copypath" class="form-control" value="http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}">
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <a class="btn btn-primary" target=_blank href="https://www.facebook.com/sharer/sharer.php">Share on Facebook</a> 
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <a target=_blank class="btn btn-primary" href="https://twitter.com/home?status=Help!%20My%20bike%20has%20been%20stolen!%20Will%20you%20keep%20an%20eye%20out%20for%20it?%20http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}">Share on Twitter</a> <!-- <a class="btn btn-primary" href="http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}">Direct Link</a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </div> <!-- /.div-share-bar -->

	@include('site._partials.foundit_modal')

    @section('footer')
        <script type="text/javascript">
            $('.foundItButtonJS').click(function(e){
                e.preventDefault();
                var bike_uid = $(this).attr('data-bike-uid');
                $('#bikeUidInput').val(bike_uid);
            });

        </script>
    @stop

@stop
