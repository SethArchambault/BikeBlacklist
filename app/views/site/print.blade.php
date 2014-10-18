@extends('site._layouts.print')

@section('title')
<title>Help Me Find My Bike - {{ $bike->description }} - Detroit Bike Blacklist</title>
@stop

@section('header')
<link rel="stylesheet" type="text/css" media="all" href="/bike_print.css">
@stop
@section('main')

<h1 class="print_page_width">MY BIKE IS MISSING!</h1>
<div id="bike-description" class="print_page_width">{{ $bike->description }}</div>
<div class="print_page_width bike_image_div">
<img id="bike-image" src="/uploads/large/{{ $bike->photo }}">
</div>
<div class="print_page_width footer_box footer_text">
<div class="footer_bike_image_div"><img src="/images/x_bike.png" width=60></div>
<span class="footer_bold_text">Find it? Report it!</span> (<span class="footer_italic_text">It only takes 5 seconds</span>)</i><br>
<div class="footer_bike_link">http://detroitbikeblacklist.com/bike/{{ $bike->bike_uid }}</div>
<div class="clear"></div>
</div>


@stop
