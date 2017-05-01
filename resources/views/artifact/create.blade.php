@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add a New Artifact</div>
                <div class="panel-body">
                    

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/artifact') }}" enctype="multipart/form-data">
        
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">File</label>

                            <div class="col-md-6">
                  <input type="file" class="form-control" name="file" value="{{ old('file') }}"/>

                            @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

         <div class="form-group{{ $errors->has('component') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Component</label>

                            <div class="col-md-6">

                                {!! Form::select('component', $components, null, ['class' => 'form-control']) !!}

                                @if ($errors->has('component'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('component') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="assignment_id" value="{{ $project->assignment_id }}">


        <div class="form-group">
                            
                <div class="col-md-6 col-md-offset-4">
                    
                    <button type="submit" class="btn btn-primary">
                         Add
                        </button>
                    </div>
                </div>
        
        </form>
   


@endsection