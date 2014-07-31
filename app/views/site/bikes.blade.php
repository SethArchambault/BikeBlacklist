@extends('site._layouts.master')

@section('title')
<title>Detroit Bike Blacklist - A super simple way for reporting your bike stolen, and a super simple way for letting the bike owner know you've found it. That's it.</title>
@stop


@section('header')
<link rel="stylesheet" type="text/css" href="/bikes_style.css">

<!-- for Google -->
<meta name="description" content="A super simple way for reporting your bike stolen, and a super simple way for letting the bike owner know you've found it. That's it." />
<meta name="keywords" content="detroit, mssing, stolen, bike, bicycle" />

<meta name="author" content="Blikelist" />
<meta name="copyright" content="2014" />
<meta name="application-name" content="Blikelist" />

<!-- for Facebook -->          
<meta property="og:title" content="Detroit Bike Blacklist" />
<meta property="og:type" content="article" />
<meta property="og:image" content="http://detroitbikeblacklist.com/images/detroit-bike-blacklist-logo-square.png" />
<meta property="og:url" content="http://detroitbikeblacklist.com/" />
<meta property="og:description" content="A super simple way for reporting your bike stolen, and a super simple way for letting the bike owner know you've found it. That's it." />

<!-- for Twitter -->          
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="Detroit Bike Blacklist" />
<meta name="twitter:description" content="A super simple way for reporting your bike stolen, and a super simple way for letting the bike owner know you've found it. That's it." />
<meta name="twitter:image" content="http://detroitbikeblacklist.com/images/detroit_bike_blacklist_header_logo.png" />
@stop

@section('main')
	<div class="container" id="main">

		@include('site._partials.flash_message')
		<div class="subtext col-sm-12 text-center">
            <h1>GOOD BIKE, GO HOME</h1>
            These are all the bikes missing in Detroit.<br>
            If you find one or (ugh) buy one, click “I&nbsp;FOUND&nbsp;IT” <br>
            to send the owner a message
        </div>
        <div style="padding-bottom:15px;" class="visible-xs"><a href="/my-bike-is-missing" class="btn btn-block btn-primary">MY BIKE IS MISSING</a></div>

			@if (count($bikes) > 0)
			@else

				<div class="alert alert-info" role="alert">
				<p>No bikes have been stolen in Detroit! Really? That can't be - it's probably just because this site is really new!</p>
				<p>If you've had your bike stolen, I would really appreciate it if you take 12 seconds to report it.</p>
				<p>It's painless, I promise. Thank you!</p>

		        <div style="padding:15px 0 0;"><a href="/my-bike-is-missing" class="btn btn-primary">MY BIKE IS MISSING</a></div>
			
				</div>
			@endif

		<div class="row">
            @foreach ($bikes as $bike)

				<div class="col-sm-4 col-md-3">
                    <div class="div-bike">
					<a href="/bike/{{ $bike->bike_uid }}">
                        <img src="/uploads/thumb/{{ $bike->photo }}" width="100%"alt="">
                        <div class="text-center date">{{ date('Y') != date('Y', strtotime($bike->lost_date)) ? "" : date('l,', strtotime($bike->lost_date)) }} {{ date('F jS', strtotime($bike->lost_date)) }} {{ date('Y') == date('Y', strtotime($bike->lost_date)) ? "" : date('Y', strtotime($bike->lost_date)) }}</div>
                        <div class="description">{{ $bike->description }}</div>
                    </a>
					    @if($bike->status == 0)
		    		    <a href="#" class="btn-i-found-it btn-block text-center foundItButtonJS" data-dismiss="modal" data-bike-uid="{{ $bike->bike_uid }}" data-toggle="modal" data-target="#foundItModal" role="button">I FOUND IT</a>
		    		    @elseif($bike->status == 1)
		    		    <a href="/bike/{{ $bike->bike_uid }}" class="btn-bike-found btn-block text-center" role="button">BIKE WAS FOUND</a>
		    		    @endif
                    </div>
				</div>
				<?php
				?>
			@endforeach
		</div>
		<!--
				<div class="alert alert-info" role="alert">
				<p>I've just put this site out into the world, and the first bike has already been submitted. Thank you! But before I begin driving traffic to the site, I'd like to have as many bikes on the site as possible. If you've had your bike stolen, I would really appreciate it if you take 12 seconds to report it.</p>
				<p>It's painless, I promise. Thanks!</p>
		        <div style="padding:15px 0 0;" class="hidden-xs"><a href="/my-bike-is-missing" class="btn btn-primary">MY BIKE IS MISSING</a></div>
				</div>
				-->
	</div>

	@include('site._partials.foundit_modal')


@stop

@section('footer')
	<script type="text/javascript">

		$('#subbutton').click(function() {
			$('#photo').click();
		});

		$('#photo').change(function(){
			$('#subfile').val($(this).val());
		});

		$('.foundItButtonJS').click(function(e){
			e.preventDefault();
			var bike_uid = $(this).attr('data-bike-uid');
			$('#bikeUidInput').val(bike_uid);
		});
	</script>
@stop



<?php /*
$last_year = date('Y', strtotime($bike->lost_date)); // THIS WOULD GO AT THE END

@if ($last_year != "" && $last_year != date('Y', strtotime($bike->lost_date)))
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1 style="color:#ccc;">{{ date('Y', strtotime($bike->lost_date)) }}</h1>
        </div>
@endif
*/ ?>
