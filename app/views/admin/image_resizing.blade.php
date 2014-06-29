@extends('admin._layouts.master')

@section('main')
	<div class="container">
        {{ Form::open(['to' => '/admin/image_resizing', 'files' => true]) }}
			<div class="form-group">
				<div class="input-group">
					<label for="photo">Photo</label>
					<div class="input-control">
					    {{ Form::file('photo', ['id' => 'photo']) }}				
				    </div>
				</div>
			</div>
			{{ Form::submit() }}
		{{ Form::close() }}

		@if (isset($data))
		<div>
			<h1>Results</h1>
	        <h2>images</h2>
            <img src="/uploads/thumb/{{ $data['photo'] }}" alt=""/> <br>
            <img src="/uploads/large/{{ $data['photo'] }}" alt=""/> <br>
            <img src="/uploads/original/{{ $data['photo'] }}" alt=""/> <br>
        </div>
		@endif
	</div> <!-- container -->
@stop