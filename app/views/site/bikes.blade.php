@extends('site._layouts.master')

@section('main')
	<div class="container">

		@include('site._partials.flash_message')
	
		<div class="jumbotron">
<<<<<<< HEAD
	 	  <h1 class="text-center"><a href="/"><img src="/blikelist_logo.png"></a></h1>
=======
	 	  <h1 class="text-center"><a href="/">Detroit Bike Blacklist</a>
</h1>
>>>>>>> origin/stage
		  <p class="text-center" style="padding-bottom:50px;"><a class="btn btn-large btn-primary" href="/my-bike-is-missing"><b>My Bike is Missing!</b></a></p>
			@if (count($bikes) > 0)
				<p>Here are all the bikes that have gone missing in Detroit!</p>
				<p>If you spot one of these, or (gulp) buy one of these - please click "I found it!"</p>
			@else
				<p>There are no missing bikes in Detroit at the moment! ...really?</p>
			@endif
		</div>

		<hr>
		<div class="row">
		<?php
		$last_year = "";
		?>
            @foreach ($bikes as $bike)
            <?php /*
    			@if ($last_year != "" && $last_year != date('Y', strtotime($bike->lost_date)))
		            </div>
		            <div class="row">
						<div class="col-xs-12">
				            <h1 style="color:#ccc;">{{ date('Y', strtotime($bike->lost_date)) }}</h1>
				        </div>
	            @endif
	            */ ?>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<div style="width:300px; height:200px; overflow:hidden;">
						  	<div style="margin-left:0px; margin-top:-70px;">
							 	<a href="/bike/{{ $bike->bike_uid }}"><img src="{{ $bike->photo }}" width=300 alt="..."></a>
							</div>
						</div>
					  <div class="caption">
					    <p>{{ date('l,', strtotime($bike->lost_date)) }} <b>{{ date('F jS', strtotime($bike->lost_date)) }}</b> {{ date('Y') == date('Y', strtotime($bike->lost_date)) ? "" : date('Y', strtotime($bike->lost_date)) }}</p>
					    <p>{{ $bike->description }}</p>
					    @if($bike->status == 0)
		    		    <p><a href="#" class="btn btn-primary btn-lg foundItButtonJS" data-dismiss="modal" data-bike-uid="{{ $bike->bike_uid }}" data-toggle="modal" data-target="#foundItModal" role="button">I Found It!</a> </p>
		    		    @elseif($bike->status == 1)
		    		    <p><a href="/bike/{{ $bike->bike_uid }}" class="btn btn-success btn-lg" role="button">Bike Found!</a> </p>
		    		    @endif
					  </div>
					</div>
				</div>
				<?php
				$last_year = date('Y', strtotime($bike->lost_date));
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
