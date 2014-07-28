<!DOCTYPE html>
<html>
<head>
	<title>BlikeList - Detroit Bike Blacklist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/lib/eternicode-datepicker/css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="/style.css">

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
		    <a class="navbar-brand" href="/"></a>
		  </div>

		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">
		    	<li><a href="/admin/user_index">User Index</a></li>
				<li><a href="/admin/bike_index">Bike Index</a></li>
				<li><a href="/admin/image_resizing">Image Resizing</a></li>
				<li><a href="/login">Login</a></li>
				<li><a href="/admin/logout">Logout</a></li>
		    </ul>

		  </div><!-- /.navbar-collapse -->
		</nav>
	@if(Session::has('message'))
	    <div class="alert alert-info">
	        <h2>{{ Session::get('message') }}</h2>
	    </div>
	@endif;
    @yield('main')

</body>
</html>
