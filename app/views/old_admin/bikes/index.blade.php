@extends('admin._layouts.default')
 
@section('main')
        <div class="container">
        <table class="table table-striped table-bordered">
                <thead>
                        <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>When</th>
                                <th><i class="icon-cog"></i></th>
                        </tr>
                </thead>
                <tbody>
                        @foreach ($bikes as $bike)
                                <tr>
                                        <td>{{ $bike->id }}</td>
                                        <td><a href="{{ URL::route('admin.bikes.show', $bike->id) }}">{{ $bike->description }}</a></td>
                                        <td>{{ $bike->created_at }}</td>
                                        <td>
                                                <a href="{{ URL::route('admin.bikes.edit', $bike->id) }}" class="btn btn-success btn-sm pull-left">Edit</a>
 
                                                {{ Form::open(array('route' => array('admin.bikes.destroy', $bike->id), 'method' => 'delete')) }}
                                                        <button type="submit" href="{{ URL::route('admin.bikes.destroy', $bike->id) }}" class="btn btn-danger btn-sm">Delete</button>
                                                {{ Form::close() }}
                                        </td>
                                </tr>
                        @endforeach
                </tbody>
        </table>
        <A href="{{ URL::route('admin.bikes.create') }}">Create</A>
        </div>
@stop