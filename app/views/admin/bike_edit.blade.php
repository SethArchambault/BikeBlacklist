@extends('admin._layouts.master')

@section('main')
	<div class="container">
		<div class="row">
			<div class="col-xs-4" style="padding-top:50px;">				
				<form role="form" action="/admin/bike_update/{{ $bike->id }}" method="post">
					<div class="form-group">
						<label>id</label>
						{{ $bike->id }}
					</div>				
					<div class="form-group">
					<label>bike_uid</label>
					{{ $bike->bike_uid }}
					</div>				
					<div class="form-group">
					<label>description</label>
					<textarea class="form-control" name="description">{{ $bike->description }}</textarea>
					</div>				
					<div class="form-group">
					<label>status</label>
					{{ $bike->status }}
					</div>				
					<div class="form-group">
					<label>photo</label><br>
					{{ $bike->photo }}<br>
					<input type="checkbox" name="resave_photo_check" id="resave_photo_check"> <label for="resave_photo_check">Resave Photo</label>
					</div>				
					<div class="form-group">
						<label>lost_date</label>
						<input type="text" class="form-control" name="lost_date" value="{{ $bike->lost_date }}">
					</div>				
					<div class="form-group">
					<label>found_key</label>
					{{ $bike->found_key }}
					</div>				
					<div class="form-group">
					<label>found_date</label>
					{{ $bike->found_date }}
					</div>				
					<div class="form-group">
					<label>found_story</label>
					{{ $bike->found_story }}
					</div>				
					<div class="form-group">
					<label>email</label>
					{{ $bike->email }}
					</div>				
					<input type="submit" value="Save" class="btn btn-primary">
				</form>
			</div>

		</div>
	</div> <!-- container -->
@stop