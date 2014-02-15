@if(Session::has('message'))
    <div class="alert alert-info">
        <h2>{{ Session::get('message') }}</h2>
    </div>
@endif
