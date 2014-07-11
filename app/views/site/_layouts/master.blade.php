<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="/favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
	<title>Detroit Bike Blacklist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/lib/eternicode-datepicker/css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="/style.css">
    @section('header')

    @show

</head>
<body>
    @section('nav')
		<nav class="navbar navbar-default" role="navigation">
	        <div class="container">

			  <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			      <span class="sr-only">Toggle navigation</span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			    </button>
			    <a class="navbar-brand" href="/"><img src="/images/detroit_bike_blacklist_header_logo.png" alt="Detroit Bike Blacklist"></a>
			  </div>

			  <!-- Collect the nav links, forms, and other content for toggling -->
			  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    <ul class="nav navbar-nav">
			    </ul>
				  <ul class="nav navbar-nav navbar-right">
			        <li><a href="/">LOST BIKES</a></li>
			        <li><a href="/about">ABOUT</a></li>
			        <li><a href="/feedback">FEEDBACK</a></li>
                    <li class="li-missing-bike"><a href="/my-bike-is-missing" class="btn-missing-bike">MY BIKE IS MISSING</a></li>
				  </ul>

			  </div><!-- /.navbar-collapse -->
		  </div><!-- /.container -->
		</nav>

    @show


    @yield('main')

	<script type="text/javascript" src="/lib/jquery/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/lib/eternicode-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
		$('#lost_date').datepicker({
			todayHighlight: true,
			orientation: "bottom left"
		});
	</script>
    @section('footer')
    @show
	@include('site._partials.piwik')
</body>
</html>
