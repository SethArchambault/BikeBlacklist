@extends('site._layouts.master')

@section('main')
	<div class="container">
		<!-- Button trigger modal -->

		<div class="jumbotron">
		  <h1>The Detroit Bike Blacklist</h1>
		  <p><a class="btn btn-large btn-primary" href="#" data-toggle="modal" data-target="#reportModal" role="button">My Bike is Missing!</a></p>
			<p>Here are all the bikes that have gone missing in Detroit!</p>
			<p>If you spot one of these, or (gulp) buy one of these - please click "I found it!"</p>

		</div>

		<hr>
		<div class="row">
            @foreach ($bikes as $bike)
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<div style="width:300px; height:200px; overflow:hidden;">
						  	<div style="margin-left:0px; margin-top:-70px;">
							 	<a href="#" data-toggle="modal" data-target="#screenshotModal"><img src="{{ $bike->photo }}" width=300 alt="..."></a>
							</div>
						</div>
					  <div class="caption">
					    <p>{{ date('l,', strtotime($bike->lost_date)) }} <b>{{ date('F jS', strtotime($bike->lost_date)) }}</b> {{ date('Y', strtotime($bike->lost_date)) }}</p>
					    <p>{{ $bike->description }}</p>
					    <p><a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#foundItModal" role="button">I Found It!</a> </p>
					  </div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

	@include('site._partials.report_modal')

	@include('site._partials.screenshot_modal')

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
	</script>
@stop