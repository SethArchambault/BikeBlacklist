@extends('site._layouts.master')

@section('header')
<link rel="stylesheet" type="text/css" href="/bikes_style.css">
@stop

@section('main')
	<div class="container" id="main">

		@include('site._partials.flash_message')
		<div class="subtext col-sm-12 text-center">
            <h1>GOOD BIKE, GO HOME</h1>
            These are all the bikes missing in Detroit.<br>
            If you find one or (ugh) buy one click “I&nbsp;FOUND&nbsp;IT” <br>
            to send the owner a message
        </div>
        <div style="padding-bottom:15px;" class="visible-xs"><a href="/my-bike-is-missing" class="btn btn-block btn-primary">MY BIKE IS MISSING</a></div>

        <div class="alert alert-info">I'm working on this site as we speak. It will be ready to be used on July 30th 2014 (my Detroit-iversery)</div>

			@if (count($bikes) > 0)
			@else
				<div class="alert alert-info" role="alert">There are no missing bikes in Detroit at the moment!<br>...really?</div>
			@endif

		<div class="row">
            @foreach ($bikes as $bike)

				<div class="col-sm-4 col-md-3">
                    <div class="div-bike">
					<a href="/bike/{{ $bike->bike_uid }}">
                        <img src="/uploads/thumb/{{ $bike->photo }}" width="100%"alt="">
                        <div class="text-center date">{{ date('l,', strtotime($bike->lost_date)) }} {{ date('F jS', strtotime($bike->lost_date)) }} {{ date('Y') == date('Y', strtotime($bike->lost_date)) ? "" : date('Y', strtotime($bike->lost_date)) }}</div>
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
