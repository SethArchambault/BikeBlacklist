@extends('site._layouts.master')

@section('title')
<title>Feedback - Detroit Bike Blacklist</title>
@stop


@section('header')
<link rel="stylesheet" type="text/css" href="/missing_bike.css">
@stop

@section('main')
<div class="container fuelux" id="main">
    <!-- Button trigger modal -->

    <h1>FEEDBACK</h1>
    <div class="row">
        <div class="col-sm-9">
        <p>
            Ultimately this site will not be useful without feedback from the biking community. What can this site do better? Anything broken? Let me know!
        </p>
        <p><a href="https://trello.com/b/4bgrlZvK/detroit-bike-blacklist" target="_blank"><span class="glyphicon glyphicon-arrow-right"></span> Vote Up New Features</a></li> 
        <p><a href="https://www.facebook.com/BikeBlacklist"><span class="glyphicon glyphicon-arrow-right"></span> Discuss Ideas on Facebook</a></p>
        </div>

    </div>
    {{ Form::open(['route' => 'site.mail_feedback', 'files' => true, 'role' => 'form']) }}
    <h2 id="contact-me">Send Me a Message</h2>
    <p>I read each and every one of these. Leave your email if you want me to get back with you. (Definitely do this if you're having any trouble!)</p>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-8 col-md-7 col-lg-6">
                {{ Form::textarea('message', '',  ['id' => '', 'class' => 'form-control',  'rows' => 8, 'placeholder' => '']) }}
            </div>
        </div>
    </div>
    <div class="row" style="padding-top:15px;">
        <div class="col-sm-5 col-md-4 col-lg-3">
            {{ Form::submit('SEND', array('class' => 'btn btn-primary btn-block btn-lg')) }}
        </div>
    </div>

    <hr>
    <h2>Discuss Publicly</h2>
    <p>Suggest features</p>
   <div id="disqus_thread" style="padding-top:50px;"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'detroitbikeblacklist'; // required: replace example with your forum shortname
        var disqus_title = "About Detroit Bike Blacklist";
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>

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
