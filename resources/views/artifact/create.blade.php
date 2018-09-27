@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add additional artifacts to: {{ $component->assignment->title}} {{ $component->title}}</div>
                <div class="panel-body">
     

     <form  role="form" method="POST" action="{{ url('/artifact') }}" enctype="multipart/form-data">
                        
        {!! csrf_field() !!}

        <span class="btn btn-default btn-file">Select File
        <input type="file" class="btn btn-default" name="file" value="{{ old('file') }}"/></span>
                   
        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
        <input type="hidden" name="assignment_id" value="{{$component->assignment_id}}">
        <input type="hidden" name="component_id" value="{{$component->id}}">
        
       <button id="upload" type="submit" class="btn btn-success">Upload
       </button>

        <!-- File Uplaod Errors-->

        @if ($errors->has('file'))
        
            <span class="help-block">
            <strong>{{ $errors->first('file') }}</strong>
            </span>
        
        @endif
                                        
        </form>               




@endsection