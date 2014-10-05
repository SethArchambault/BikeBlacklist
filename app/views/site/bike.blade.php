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

<!-- leaflet -->
<link rel="stylesheet" href="/lib/leaflet-0.7.3/leaflet.css" />

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
                    @if ($bike->lost_latitude != 0 && $bike->lost_longitude != 0)
                    <div style="padding:20px 0;">
                        <div id="map"  style="height:161px;"></div>
                    </div>
                    @endif

                    <div id="div-share">
                        <p>Share this link with everyone you know:</p>
                        <div class="row">
                            <div class="col-sm-7 col-xs-12" style="padding-bottom:15px;">
                                <input type="text" id="copypath" class="form-control" value="http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}">
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <a class="btn btn-primary share-social-link" target=_blank href="https://www.facebook.com/sharer/sharer.php">Share on Facebook</a> 
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <a target=_blank class="btn btn-primary share-social-link" href="https://twitter.com/home?status=Help!%20My%20bike%20has%20been%20stolen!%20Will%20you%20keep%20an%20eye%20out%20for%20it?%20http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}">Share on Twitter</a> <!-- <a class="btn btn-primary" href="http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}">Direct Link</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.div-share-bar -->
    <div class="container">
        <div class="row" style="padding:40px 0 50px;">
            <div class="col-sm-6">
                <h1>Lessons Learned</h1>
                <p>{{$bike->advice}}</p>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>

	@include('site._partials.foundit_modal')

    @section('footer')
        <script src="/lib/leaflet-0.7.3/leaflet.js"></script>

        <script type="text/javascript">
            $('.foundItButtonJS').click(function(e){
                e.preventDefault();
                var bike_uid = $(this).attr('data-bike-uid');
                $('#bikeUidInput').val(bike_uid);
            });

            // leaflet - use this if there is a bike lat and long
            var longitude = {{ $bike->lost_longitude}};
            var latitude = {{ $bike->lost_latitude}};
            var offset = 0;//.001;

            if (latitude != 0 && longitude != 0){
                drawMap();
            }

            function drawMap() {
                var map = L.map('map',  {zoomControl:false}).setView([latitude+offset, longitude], 15);
                var marker = L.circle([latitude, longitude], 40,
                    { 
                        'opacity'   : 0,
                        'color'     : '#5989ff',
                        'weight'    : 2,
                        'fillOpacity'   : .7
                    }
                ).addTo(map);
                // map.dragging.disable();
                map.touchZoom.disable();
                map.doubleClickZoom.disable();
                map.scrollWheelZoom.disable();
                map.boxZoom.disable();
                map.keyboard.disable();
                map.attributionControl.setPrefix('');
                var popup = L.popup({closeButton:true})
                    .setLatLng([latitude, longitude])
                    .setContent("Last seen @ <b>{{ ucwords($bike->lost_location) }}</b>");
                marker.bindPopup(popup)


                var layer = L.tileLayer('http://{s}.tiles.mapbox.com/v3/doercreator.j6n1l8fo/{z}/{x}/{y}.png', {
                    attribution: '',
                    maxZoom: 18
                }).addTo(map);
            }



        </script>
    @stop

@stop
