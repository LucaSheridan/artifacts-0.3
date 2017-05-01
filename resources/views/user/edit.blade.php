@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>
                <div class="panel-body">


           

        <form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@update', $user->id) }}" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="_method" value="PATCH">

        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            
        {!! Form::label('firstName', 'First Name', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
        
        <input type="text" class="form-control" name="firstName" value="{{ $user->firstName }}">

                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            
        {!! Form::label('lastName', 'Last Name', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
        
        <input type="text" class="form-control" name="lastName" value="{{ $user->lastName }}">

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            
        {!! Form::label('email', 'Email', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
        
        <input type="text" class="form-control" name="email" value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
        

        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                 Update
                                </button>
                            </div>
                        </div>
                    </form>
   
</form>

@endsection