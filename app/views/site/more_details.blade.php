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
		<h1>SUCCESS</h1>
        @include('site._partials.flash_message')
        <p><strong>...But Before You Go</strong></p>
        <div class="row">
        <p class="col-sm-9">If you have 3 more minutes here’s some other fields that will help get your bike back!<!--<br>You don’t have to do them all now, you can always fill this out later. --></p>
        </div>
        {{ Form::open(['route' => 'site.store_more_details', 'files' => true, 'role' => 'form']) }}
            <div class="form-group">
                <label for="description">Where was your bike placed?</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-7 col-lg-6">
                            {{ Form::textarea('bike_placement', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'On a parking meter.']) }}
                        </div>
                    </div>
                <div class="row">
                    <p class="help-block col-sm-8 col-md-7 col-lg-6">Was your bike in your garage? On your porch? On a parking meter? Was it well lit?</p>
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
                            {{ Form::textarea('lock_method', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'I locked up the top tube.']) }}
                        </div>
                    </div>
                <div class="row">
                    <p class="help-block col-sm-8 col-md-7 col-lg-6">What part of the bike did you lock? <a href="http://www.jimlangley.net/wrench/bicycleparts.html" target="_blank">This chart may help</a>. </p>
                </div>
            </div>
            <div class="form-group">
                <label for="description">How Was It Stolen?</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-7 col-lg-6">
                            {{ Form::textarea('theft_desc', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'When I came out of my house - I found the lock cut in half.']) }}
                        </div>
                    </div>
                <div class="row">
                    <p class="help-block col-sm-8 col-md-7 col-lg-6">Did they cut the lock, or just take the unlocked parts? Did you see it happen?</p>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Advice for Others</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-7 col-lg-6">
                            {{ Form::textarea('advice', '',  ['class' => 'form-control', 'maxlength' => 140, 'rows' => 2, 'placeholder' => 'Always lock up your bike.']) }}
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
                        {{ Form::text('serial_num', '',  ['id' => 'lost_location', 'class' => 'form-control', 'placeholder' => '270821, for example']) }}
                    </div>
                </div> <!-- /.row -->
                <p class="help-block">This is usually found on the bottom of the bike between the pedals.</p>
                <div class="row" style="padding-top:15px;">
                    <div class="col-sm-5 col-md-4 col-lg-3">
                        {{ Form::submit('SAVE', array('id' => 'submit-btn-js', 'class' => 'btn btn-primary btn-block btn-lg')) }}
                    </div>
                </div>
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
