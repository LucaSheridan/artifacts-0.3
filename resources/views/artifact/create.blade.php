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

        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">

        <div class="form-group">
                            
                <div class="col-md-6 col-md-offset-4">
                    
                    <button type="submit" class="btn btn-primary">
                         Add
                        </button>
                    </div>
                </div>
        
        </form>

        <hr>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/artifact') }}" enctype="multipart/form-data">
        
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Dropzone</label>

                            <div class="col-md-6">
                  <input type="file" class="form-control" name="file" value="{{ old('file') }}"/>

                            @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">

        <div class="form-group">
                            
                <div class="col-md-6 col-md-offset-4">
                    
                    <button type="submit" class="btn btn-primary">
                         Add
                        </button>
                    </div>
                </div>
        
        </form>

        <hr>

        <form action="{{ url('/artifact') }}" class="dropzone" id="my-awesome-dropzone">
        
            <!-- Non-Javascript Fallback -->
            <div class="fallback"><input name="file" type="file" multiple /></div>

        </form>   


@endsection