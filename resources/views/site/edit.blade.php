@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Edit a Site</div>
                <div class="panel-body">


           

        <form class="form-horizontal" role="form" method="POST" action="{{ action('SiteController@update', $site->id) }}" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
        <input type="hidden" name="_method" value="PATCH">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            
        {!! Form::label('name', 'Site Name', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
        
        <input type="text" class="form-control" name="name" value="{{ $site->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
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