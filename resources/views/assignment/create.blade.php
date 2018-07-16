@extends('layouts.app')

@section ('title')
<title>Create Assignment</title>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               
            <div class="panel-heading">Add a New Assignment</div>
            <div class="panel-body">


    <form class="form-horizontal" role="form" method="POST" action="{{ url('/assignment') }}">
        
    {!! csrf_field() !!}
    {!! Form::hidden('section_id', $section->id) !!}


    <!-- Title -->

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    
            <label class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
                     
            <div>{!! Form::text('title', null, ['class' => 'form-control']) !!}</div>

             @if ($errors->has('title'))
            
                 <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                 </span>
                 
             @endif
            
            </div>
    </div>


    <!-- Description -->

    <!-- <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    
            <label class="col-md-4 control-label">Description</label>

            <div class="col-md-6">

            <div>{!! Form::text('description', null, ['class' => 'form-control']) !!}</div>

            @if ($errors->has('description'))
            
                 <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                 </span>
                 
            @endif
            
            </div>
      </div> -->
        
<div class="form-group">

            <label class="col-md-4 control-label"></label>

            <div class="col-md-6">
                
                <button type="submit" class="btn btn-primary">
                    Create Assignment
                </button>

            </div>
        </div>
        
</div>
    
</form>

@endsection



