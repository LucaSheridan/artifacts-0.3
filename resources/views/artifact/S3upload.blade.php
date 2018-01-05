@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Amazon S3 Uploader</div>
                <div class="panel-body">


        <form class="form-horizontal" role="form" method="POST" action="test" enctype="multipart/form-data">
        
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

        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">User ID</label>

                            <div class="col-md-6">
                  <input type="text" class="form-control" name="user_id" value="{{ old('user_id') }}"/>

                            @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <div class="form-group{{ $errors->has('assignment_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Assignment ID</label>

                            <div class="col-md-6">
                  <input type="text" class="form-control" name="assignment_id" value="{{ old('assignment_id') }}"/>

                            @if ($errors->has('assignment_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('assignment_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <div class="form-group{{ $errors->has('component_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Component ID</label>

                            <div class="col-md-6">
                  <input type="text" class="form-control" name="component_id" value="{{ old('component_id') }}"/>

                            @if ($errors->has('component_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('component_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <div class="form-group">
                            
                <div class="col-md-6 col-md-offset-4">
                    
                    <button type="submit" class="btn btn-primary">
                         Upload to Amazon S3 bucket
                        </button>
                    </div>
                </div>
        
        </form>

        <hr>

        <form action="test"
        class="dropzone"
        id="my-awesome-dropzone">
            
        <input name="_token" type="hidden" value="{{ csrf_token() }}">    
        </form>
   
        <script src="{{ asset('js/dropzone.js') }}"></script>



@endsection