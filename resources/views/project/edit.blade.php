@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Project</div>
                <div class="panel-body">


         <!-- Begin Form --> 

        <form class="form-horizontal" role="form" method="POST" action="{{ action('ProjectController@update', $project->id) }}" enctype="multipart/form-data">

            {!! csrf_field() !!}

            <input type="hidden" name="_method" value="PATCH">

        <!-- Title Input -->

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                
                {!! Form::label('title', 'Project Title', array('class' => 'col-md-4 control-label')) !!}

                <div class="col-md-6">
            
                <input type="text" class="form-control" name="title" value="{{ $project->title }}">

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif

                </div>
            </div>

         <!-- Medium Input -->

            <div class="form-group{{ $errors->has('medium') ? ' has-error' : '' }}">
                                
                {!! Form::label('medium', 'Medium', array('class' => 'col-md-4 control-label')) !!}

                <div class="col-md-6">
            
                <input type="text" class="form-control" name="medium" value="{{ $project->medium }}">

                        @if ($errors->has('medium'))
                            <span class="help-block">
                                <strong>{{ $errors->first('medium') }}</strong>
                            </span>
                        @endif
                </div>
            </div>        

             <!-- Dimensions Input -->

            <div class="form-group{{ $errors->has('dimensions') ? ' has-error' : '' }}">
                                
                {!! Form::label('dimensions', 'Dimensions', array('class' => 'col-md-4 control-label')) !!}

                <div class="col-md-6">
            
                <input type="text" class="form-control" name="dimensions" value="{{ $project->dimensions }}">

                        @if ($errors->has('dimensions'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dimensions') }}</strong>
                            </span>
                        @endif
                </div>
            </div>       

        <!-- Submit Button -->

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                 Update Project
                </button>
            </div>
        </div>

        </div> 
        </div>
       
</form>

@endsection