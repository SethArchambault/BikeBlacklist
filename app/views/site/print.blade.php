@extends('site._layouts.print')

@section('title')
<title>Help Me Find My Bike - {{ $bike->description }} - Detroit Bike Blacklist</title>
@stop

@section('header')
<link rel="stylesheet" type="text/css" media="all" href="/bike_style.css">

@section('main')

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
                <div class="text-center">
                    <h1 style="margin:0;">MISSING BIKE</h1>
                <div id="bike-description" class="text-center">{{ $bike->description }}</div>


                    <img style="padding-top:0;" id="bike-image" src="/uploads/large/{{ $bike->photo }}">
                </div>
                    <div class="text-center" style="font-size:20px;">
                    Report Sightings to the Owner:<Br>http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}
                  </div>

        	</div>
		</div> <!-- /.row -->
    </div> <!-- /.container -->


@stop
