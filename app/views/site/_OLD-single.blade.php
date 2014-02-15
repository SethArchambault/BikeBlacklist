@extends('_layouts.master')

@section('main')
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="thumbnail">
					<div class="row">
						<div class="col-xs-12" style="">
							<div style="overflow:hidden; max-height:500px;">
							  	<div style="margin-left:0px; margin-top:-270px;">
								 	<a href="#" data-toggle="modal" data-target="#screenshotModal"><img src="http://media.tumblr.com/007a6b5111a276afefc497f5e494d898/tumblr_inline_mubo67Imcy1qg88vl.jpg" width="100%" style="min-width:300px;" alt="..."></a>
								</div>
							</div>
						</div>
					</div>
					<div class="caption">
						<h3>December 3rd</h3>
						<p>Has a coaster brake</p>
						<p><a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#foundItModal" role="button">I Found It!</a> </p>
					</div>
				</div>
			</div>	
		</div>
	</div>
	
	@include('_partials.screenshot_modal')

	@include('_partials.foundit_modal')

@stop

@section('footer')
	<script src="lib/leaflet/leaflet.js"></script>

	<script type="text/javascript">
		var map = L.map('map').setView([51.505, -0.09], 13);
		L.tileLayer('http://{s}.tile.cloudmade.com/d352ea255faa47a8940f482ecfaf9574/997/256/{z}/{x}/{y}.png', {
		    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
		    maxZoom: 18
		}).addTo(map);

		var marker = L.marker([51.5, -0.09]).addTo(map);
	</script>
@stop


