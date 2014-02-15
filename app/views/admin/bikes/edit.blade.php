@extends('admin._layouts.default')
 
@section('main')
 	<div class="container">

        <h2>Edit bike</h2>
 
        {{ Form::model($bike, array('method' => 'put', 'route' => array('admin.bikes.update', $bike->id))) }}
 
                <div class="control-group">
                        {{ Form::label('lost_date', 'Lost Date') }}
                        <div class="controls">
                                {{ Form::text('lost_date') }}
                        </div>
                </div>
                 <div class="control-group">
                        {{ Form::label('photo', 'Photo') }}
                        <div class="controls">
                                {{ Form::text('photo') }}
                        </div>
                </div>
                <div class="control-group">
                        {{ Form::label('description', 'Description') }}
                        <div class="controls">
                                {{ Form::textarea('description') }}
                        </div>
                </div>
 
                <div class="form-actions">
                        {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
                        <a href="{{ URL::route('admin.bikes.index') }}" class="btn btn-large">Cancel</a>
                </div>
 
        {{ Form::close() }}
    </div>
 
@stop