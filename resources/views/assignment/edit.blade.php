@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Assignment</div>
                <div class="panel-body">


         <!-- Begin Form --> 

        <form class="form-horizontal" role="form" method="POST" action="{{ action('AssignmentController@update', $assignment->id) }}" enctype="multipart/form-data">

            {!! csrf_field() !!}

            <input type="hidden" name="_method" value="PATCH">

        <!-- Title Input -->

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                
                {!! Form::label('title', 'Assignment Title', array('class' => 'col-md-4 control-label')) !!}

                <div class="col-md-6">
            
                <input type="text" class="form-control" name="title" value="{{ $assignment->title }}">

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                </div>
            </div>

            <!-- Description Input -->

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                
                {!! Form::label('description', 'Description', array('class' => 'col-md-4 control-label')) !!}

                <div class="col-md-6">
            
                <input type="text" class="form-control" name="description" value="{{ $assignment->description }}">

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                </div>
            </div>

        <!-- Submit Button -->

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                 Update Assignment
                </button>
            </div>
        </div>

        <a class='btn btn-danger' href='{{action('AssignmentController@delete', $assignment->id)}}'>Delete Assignment</a>
       
</form>

</div>
</div>

@endsection