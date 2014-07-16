@extends('site._layouts.master')

@section('header')
<link rel="stylesheet" type="text/css" href="/missing_bike.css">
@stop

@section('main')
<div class="container fuelux" id="main">
    <!-- Button trigger modal -->

    <h1>ABOUT</h1>
    <div class="row">
        <p class="col-sm-9">
            <a href="http://imovedtodetroit.com/post/63417216312/theft-guilt-part-1">Theft Guilt - Part 1. The Motivation of Detroit Bike Blacklist</a>
            <a href="http://imovedtodetroit.com/post/76522601034/the-fourth-wall-of-detroit">The Fourth Wall of Detroit - The Origin of Detroit Bike Blacklist</a>
        </p>
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
