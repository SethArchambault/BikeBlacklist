@extends('site._layouts.master')

@section('header')
@stop

@section('main')
	<div class="container fuelux">
		<!-- Button trigger modal -->

		<h1>My Bike is Missing!</h1>
		<p>First off - I'm really sorry your bike is missing.  This sucks. But don't despair. Detroit will help you get it back!</p>

        {{ Form::open(['route' => 'site.store', 'files' => true]) }}
			    <div class="form-group">
				    <div class="input-group input-group-lg">
						<label for="photo" class="input-group-addon">Photo</label>
					    <div class="form-control">
							<input type="text" name="subfile" id="subfile">
							<a class="btn" id="subbutton">Browse</a>
						</div>
					</div>
				    <p class="help-block">Upload the clearest photo of your bike</p>
				    {{ Form::file('photo', ['id' => 'photo', 'style' => 'display:none;']) }}				
			    </div>
				<div class="form-group">
				    <div class="input-group input-group-lg">
						<span class="input-group-addon">Description</span>
		                {{ Form::textarea('description', '',  ['id' => 'descJS', 'class' => 'form-control', 'maxlength' => 140,'placeholder' => 'It has a coaster brake.']) }}
					</div>
				    <p class="help-block">What else identifies your bike? Be brief - the first few words of this will appear as your unique url. <span id="uniqueUrlJS"></span></p>
			    </div>
				<div class="form-group">
				    <div id="lost_date_div" class="input-group input-group-lg">
						<span class="input-group-addon">Date</span>
		                {{ Form::text('lost_date', $todays_date,  ['id' => 'lost_date', 'class' => 'form-control', 'placeholder' => 'mm/dd/yyyy']) }}
					</div>
				    <p class="help-block">When did this happen?</p>
				</div>
				<div class="form-group">
				    <div class="input-group input-group-lg">
						<span class="input-group-addon">Email</span>
		                {{ Form::text('email', '',  ['class' => 'form-control', 'placeholder' => 'yourname@probablygmail.com']) }}
				    </div>
				    <p class="help-block">Triple check this, it's the only way someone can contact you if your bike is found.  You'll only get an email if someone finds your bike.</p>
				    {{ Form::submit('Send', array('class' => 'btn btn-primary')) }}
			    </div>


      {{ Form::close() }}
	</div>

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
			var word_array = $(this).val().split(" ");
		    word_array.splice(3, word_array.length);
			var bike_uid = word_array.join("-").toLowerCase();
			$('#uniqueUrlJS').text("http://blikelist.com/"+ bike_uid);
		});
	});

</script>
		

@stop
