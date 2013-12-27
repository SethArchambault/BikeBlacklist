<!DOCTYPE html>
<html>
<head>
	<title>Detroit Bike Blacklist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="lib/leaflet/leaflet.css" />
	<!--[if lte IE 8]>
	 <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.ie.css" />
	<![endif]-->
	<style type="text/css">
		#map { height: 300px; }
	</style>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	      <span class="sr-only">Toggle navigation</span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href="#">Detroit Bike Blacklist</a>
	  </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
	    </ul>
		  <ul class="nav navbar-nav navbar-right">
		    <li class="dropdown">
		      <a href="#" class="dropdown-toggle" data-toggle="dropdown">About <b class="caret"></b></a>
		      <ul class="dropdown-menu">
		        <li><a href="#">The Story of the List</a></li>
		        <li><a href="#">Spam Kills Kittens</a></li>
		      </ul>
		    </li>
		  </ul>

	  </div><!-- /.navbar-collapse -->
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-xs-5">
				<div class="thumbnail">
					<div class="row">
						<div class="col-xs-12" style="">
							<div style="overflow:hidden; max-height:300px;">
							  	<div style="margin-left:0px; margin-top:-70px;">
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
		    <div class="col-md-7 hidden-xs hidden-sm">
				<div id="map"></div>
		    </div>
		</div>
	</div>


	<!-- reportModal -->
	<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h1 class="modal-title" id="reportModalLabel">My Bike is Missing!</h1>
	      </div>
	      <div class="modal-body">
		    <p>First off - I'm really sorry your bike is missing.  This sucks. But don't dispair. Detroit will help you get it back!</p>
		    
		    <div class="form-group">
			    <div class="input-group input-group-lg">
					<span class="input-group-addon">Photo</span>
					<input type="file" placeholder="file" class="form-control">
				</div>
			    <p class="help-block">Upload the clearest photo of your bike</p>
		    </div>
		    
		    <div class="form-group">
			    <div class="input-group input-group-lg">
					<span class="input-group-addon">Description</span>
					<input type="text" placeholder="It has a kick brake." class="form-control">
				</div>
			    <p class="help-block">What else identifies your bike?</p>
		    </div>
		    <div class="form-group">
			    <div class="input-group input-group-lg">
					<span class="input-group-addon">Date</span>
					<input type="text" placeholder="mm/dd/yyyy" class="form-control"><br>
				</div>
			    <p class="help-block">When did this happen?</p>
			</div>

		    <div class="form-group">
			    <div class="input-group input-group-lg">
					<span class="input-group-addon">Email</span>
					<input type="text" placeholder="yourname@probablygmail.com" class="form-control">
			    </div>
			    <p class="help-block">If you'd like them to be able to contact you, leave your email.</p>
		    </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Send</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<!-- screenshot_modal -->
	<div class="modal fade" id="screenshotModal" tabindex="-1" role="dialog" aria-labelledby="screenshotModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="screenshotModalLabel">December 3rd</h4>
	      </div>
	      <div class="modal-body">
		    <p>Has a coaster brake</p>
	      	<div style="padding-bottom:10px;"><img src="http://media.tumblr.com/007a6b5111a276afefc497f5e494d898/tumblr_inline_mubo67Imcy1qg88vl.jpg"></div>
		    <p><a href="#" class="btn btn-primary btn-lg" data-dismiss="modal" data-toggle="modal" data-target="#foundItModal" role="button">I Found It!</a> </p>
		    <a href="#">Report this image</a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Send</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- found_it_modal -->
	<div class="modal fade" id="foundItModal" tabindex="-1" role="dialog" aria-labelledby="foundItModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h1 class="modal-title" id="foundItModalLabel">I FOUND IT!</h1>
	      </div>
	      <div class="modal-body">
	        <p>Pleae give whatever useful details you can + a way to reach you.</p>
	        <textarea class="col-xs-12">
	        	
	        </textarea>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Send</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script type="text/javascript" src="lib/jquery/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="lib/leaflet/leaflet.js"></script>

	<script type="text/javascript">
		var map = L.map('map').setView([51.505, -0.09], 13);
		L.tileLayer('http://{s}.tile.cloudmade.com/d352ea255faa47a8940f482ecfaf9574/997/256/{z}/{x}/{y}.png', {
		    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
		    maxZoom: 18
		}).addTo(map);

		var marker = L.marker([51.5, -0.09]).addTo(map);
	</script>
</body>
</html>
