@extends('site._layouts.master')

@section('title')
<title>My Bike Is Missing - Detroit Bike Blacklist</title>
@stop


@section('header')
<link rel="stylesheet" type="text/css" href="/missing_bike.css">
@stop

@section('main')
	<div class="container fuelux" id="main">
		<!-- Button trigger modal -->
        @include('site._partials.flash_message')
		<h1>SUCCESS</h1>
        <p><strong>...But Before You Go</strong></p>
        <div class="row">
        <p class="col-sm-9">Do you have a few more minutes? If so, here’s some other fields that will help get your bike back! You don’t have to do them all now, you can always fill this out later just remember to scroll down and save! </p>
        </div>
        <hr>
        {{ Form::open(['route' => 'site.store', 'files' => true, 'role' => 'form']) }}
            <div class="form-group">
                <label for="description">Where was your bike placed?</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-7 col-lg-6">
                            {{ Form::textarea('bike_placement', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'On a parking meter.']) }}
                        </div>
                    </div>
                <div class="row">
                    <p class="help-block col-sm-8 col-md-7 col-lg-6">Was your bike in your garage? On your porch? On a parking meter? </p>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Lock Type</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-7 col-lg-6">
                            {{ Form::textarea('lock_type', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'A kryptonite U Lock.']) }}
                        </div>
                    </div>
                <div class="row">
                    <p class="help-block col-sm-8 col-md-7 col-lg-6">What kind of lock did you use?  Know the brand? Model?</p>
                </div>
            </div>
            <div class="form-group">
                <label for="description">How Was It Locked?</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-7 col-lg-6">
                            {{ Form::textarea('bike_placement', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'I locked up the top tube.']) }}
                        </div>
                    </div>
                <div class="row">
                    <p class="help-block col-sm-8 col-md-7 col-lg-6">What part of the bike did you lock? This chart may help. In chart: On the tire etween the chainstays and the seat stays) </p>
                </div>
            </div>
            <div class="form-group">
                <label for="description">How Was It Stolen?</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-7 col-lg-6">
                            {{ Form::textarea('bike_placement', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'When I came out of my house - I found the lock cut in half.']) }}
                        </div>
                    </div>
                <div class="row">
                    <p class="help-block col-sm-8 col-md-7 col-lg-6">Did they cut the lock, or just take the unlocked parts? Did you see it happen?</p>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Advice</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-7 col-lg-6">
                            {{ Form::textarea('bike_placement', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'Always lock up your bike.']) }}
                        </div>
                    </div>
                <div class="row">
                    <p class="help-block col-sm-8 col-md-7 col-lg-6">What did you learn? Anything you’ll do differently in the future? How can someone else avoid this happening to them?</p>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="">Serial Number</label>
                <div class="row">
                    <div class="input-group col-sm-5 col-md-4 col-lg-3">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-barcode"></span></div>
                        {{ Form::text('lost_location', '',  ['id' => 'lost_location', 'class' => 'form-control', 'placeholder' => '270821']) }}
                    </div>
                </div> <!-- /.row -->
                <p class="help-block">This is usually found on the bottom of the bike between the pedals.</p>

            </div>




        {{ Form::close() }}


	</div> <!-- /.container -->

@stop

@section('footer')
<script type="text/javascript">
	$(function() {
        $('#submit-btn-js').click(function(e) {
            $(this).val('SAVING');
            // $(this).prop('disabled', true);
        });
	});

</script>
		

@stop
