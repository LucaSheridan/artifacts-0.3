@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add a New Project</div>
                <div class="panel-body">
                    

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/project') }}" enctype="multipart/form-data">
        
        {!! csrf_field() !!}

         <div class="form-group{{ $errors->has('assignment') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Assignment</label>

                            <div class="col-md-6">

                                {!! Form::select('assignment', $assignments, 'null', ['placeholder' => 'Select an Assignment...','class' => 'form-control']) !!}

                                @if ($errors->has('assignment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('assignment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
        

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
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
   
</form>

@endsection