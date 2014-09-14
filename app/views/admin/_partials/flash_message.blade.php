@if(Session::has('message'))
    <div class="alert alert-info">
        <h3>{{ Session::get('message') }}</h3>
    </div>
@endif
