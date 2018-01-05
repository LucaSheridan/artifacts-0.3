@extends('layouts.app')

@section ('title')
<title>Create Component</title>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               
            <div class="panel-heading">Add an Assignment Component to "{{$assignment->title}}"</div>
            <div class="panel-body">


    <form class="form-horizontal" role="form" method="POST" action="{{ url('/component') }}">
        
    {!! csrf_field() !!}

    {!! Form::hidden('assignment_id', $assignment->id) !!}

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


    <!-- Due Date -->

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    
            <label class="col-md-4 control-label">Due Date</label>

            <div class="col-md-6">

            <div>{!! Form::text('date_due', null, ['id' => 'datepicker', 'class' => 'form-control']) !!}</div>

            @if ($errors->has('date_due'))
            
                 <span class="help-block">
                    <strong>{{ $errors->first('date_due') }}</strong>
                 </span>
                 
            @endif
            
            </div>
      </div>
        
<div class="form-group">

            <label class="col-md-4 control-label"></label>

            <div class="col-md-6">
                
                <button type="submit" class="btn btn-primary">
                    Create Component
                </button>

            </div>
        </div>
        
</div>
    
</form>



@endsection



