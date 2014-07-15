@extends('site._layouts.master')

@section('header')
<link rel="stylesheet" type="text/css" href="/missing_bike.css">
@stop

@section('main')
	<div class="container fuelux" id="main">
		<!-- Button trigger modal -->

		<h1>MY BIKE IS MISSING</h1>
        <div class="row">
    		<p class="col-sm-9">First off - I'm really sorry your bike is missing.  This sucks. But don't despair. Detroit will help you get it back!</p>
        </div>
        <hr>
        {{ Form::open(['route' => 'site.store', 'files' => true, 'role' => 'form']) }}
			    <div class="form-group">
                    <label for="photo">Bike Photo</label>
                    <div class="row">
                        <div class="input-group col-sm-5 col-md-4 col-lg-3">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-camera"></span></div>
                            <input type="text" class="form-control" name="subfile" id="subfile">
                            <div class="input-group-btn"><a class="btn btn-default" id="subbutton">Browse</a></div>

                        </div>
                    </div>
				    <p class="help-block">Upload the clearest photo of your bike</p>
				    {{ Form::file('photo', ['id' => 'photo', 'style' => 'display:none;']) }}				
			    </div>
				<div class="form-group">
                    <label for="description">Description</label>
                        <div class="row">
                            <div class="col-sm-8 col-md-7 col-lg-6">
                                {{ Form::textarea('description', '',  ['id' => 'descJS', 'class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'It has a coaster brake.']) }}
                            </div>
                        </div>
                    <div class="row">
                        <p class="help-block col-sm-8 col-md-7 col-lg-6">What else identifies your bike? Be brief - the first few words of this will appear as your unique url. <span id="uniqueUrlJS"></span></p>
	                </div>
    		    </div>
				<div class="form-group">
                    <label for="date" class="">Date</label>
                    <div class="row">
                        <div class="input-group col-sm-5 col-md-4 col-lg-3">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                            {{ Form::text('lost_date', $todays_date,  ['id' => 'lost_date', 'class' => 'form-control', 'placeholder' => 'mm/dd/yyyy']) }}
                        </div>
                    </div> <!-- /.row -->
				    <p class="help-block">When did this happen?</p>
				</div>
				<div class="form-group">
                    <label for="email" class="">Email</label>
                    <div class="row">
                       <div class="input-group col-sm-5 col-md-4 col-lg-3">
                           <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                            {{ Form::text('email', '',  ['class' => 'form-control', 'placeholder' => 'yourname@probablygmail.com']) }}
                        </div>
                    </div> <!-- /.row -->
                    <div class="row">
                        <p class="help-block col-sm-8 col-md-7 col-lg-6">Triple check this, it's the only way someone can contact you if your bike is found. </p>
                    </div>

				    <div class="row" style="padding-top:15px;">
                        <div class="col-sm-5 col-md-4 col-lg-3">
                            {{ Form::submit('SEND', array('class' => 'btn btn-primary btn-block btn-lg')) }}
                        </div>
				    </div>
			    </div>


      {{ Form::close() }}
	</div> <!-- /.container -->

@stop

@section('footer')
<script type="text/javascript">
	$(function() {
		$('#subbutton').click(function() {
			$('#photo').click();
		});

		$('#photo').change(function(){
			$('#subfile').val($(this).val());
		});

		$('#descJS').keyup(function() {
			var word_array = $(this).val().replace(/ +/g, " ")
                .replace(/[^\w\s]/gi, '')
                .substr(0,25)
                .split(" ");
            word_array.splice(4, word_array.length);
			var bike_uid = word_array.join("-").toLowerCase();
			$('#uniqueUrlJS').text("http://bikeblacklist.com/"+ bike_uid);
		});
	});

</script>
		

@stop
