@extends('site._layouts.master')

@section('header')
<link rel="stylesheet" type="text/css" href="/missing_bike.css">
@stop

@section('title')
<title>About Detroit Bike Blacklist</title>
@stop


@section('main')
<div class="container fuelux" id="main">
    <!-- Button trigger modal -->

    <h1>ABOUT</h1>
    <div class="row">
        <div class="col-sm-9">
        <p>Detroit Bike Blacklist is a super simple way for reporting your bike stolen, and a super simple way for letting the bike owner know you've found it. That's it.</p>  
        <h2>Origin</h2>
        <p>So, in October of 2013 I found out that the bike I was riding around on was stolen property.</p>
        <p>It had been stolen from Eastern Market, donated to a local bike shop (by a parent maybe?), and I ended up buying it.</p>
        <blockquote><a href="http://imovedtodetroit.com/post/63417216312/theft-guilt-part-1" target="_blank">Read the Full Story - Theft Guilt: Part 1</a></blockquote>
        <p>I pieced this together by meeting the former bike owner, and then talking with people at the bike shop. It was no one's fault - 
        it just ended up that way.</p>
        <p>But what if there was a way to check if the bike you were getting had been stolen?</p>
        <p>Thus, the Detroit Bike Blacklist was born.</p>
        <h2>The Real Purpose</h2>
        <p>However, aside from creating a solution for bike theft reporting, I have a devious underlying plan.</p>
        <p>I don't believe the goal here is to stop bike theft. Bike theft is a symptom, not a root problem. Don't get me wrong, it sucks to get your bike stolen. But that doesn't mean that the person who stole it isn't in a worse position than you.</p>
        <p>I'm giving them the benefit of the doubt here: If they could choose, they wouldn't choose to steal bikes.</p>
        <p>Now I have no idea what the solution for this larger problem is, because I don't believe you can even talk about solutions until you understand what's going on in the first place.</p>
        <p>I want to understand bike theft, the systemic causes of it, and I want to gather that data and make it publicly accessible to inform a larger discussion.</p>
        <p>I created this site with this goal in the forefront.</p>
        <blockquote>
            <a href="http://imovedtodetroit.com/post/76522601034/the-fourth-wall-of-detroit" target="_blank">Read More - The Fourth Wall of Detroit</a>
        </blockquote>
        <h2>Features To Come</h2>
        <ul>
        <li>Adding location the bike was stolen.</li>
        <li>Easy way to printout your stolen bike.</li>
        <li>An API to access data.</li>
        <li>Connecting with local police departments.</li>
        <li><a href="/feedback">Send me your ideas!</a></li>
        </ul>
        <h2>Thanks To</h2>
        <ul>
        <li>Joey from <a href="http://thehubofdetroit.org/">the Hub</a> for pushing me to finish this thing.</li>
        <li>"Magic" for being the first to submit a bike!</li>
        <li>Hannah Hillier for advice and feedback on the business card design and logo.</li>
        <li><a href="http://saragreenedesign.com">Sara Greene</a> for design guidance on the logo and site design.</li>
        </ul>
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
