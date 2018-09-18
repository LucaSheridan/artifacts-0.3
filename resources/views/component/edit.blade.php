@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Edit a Component</div>
                <div class="panel-body">


           

        <form class="form-horizontal" role="form" method="POST" action="{{ action('ComponentController@update', $component->id) }}" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <input type="hidden" name="_method" value="PATCH">

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            
        {!! Form::label('title', 'Component Name', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
        
        <input type="text" class="form-control" name="title" value="{{ $component->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

         <div class="form-group{{ $errors->has('date_due') ? ' has-error' : '' }}">
                            
        {!! Form::label('date_due', 'Component Due Date', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">

       <input id="datepicker" type="text" class="form-control" name="date_due" value="{{ Carbon\Carbon::parse($component->date_due)->setTimezone('America/New_York')->format('m-d-y') }}">



     <!--  {!! Form::text('date_due', Carbon\Carbon::parse($component->date_due)->setTimezone('America/New_York')->format('n-j-Y') , ['id' => 'datepicker', 'class' => 'form-control']) !!}</div> -->
     <div id="datepicker"></div>

                                @if ($errors->has('date_due'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_due') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <div class="form-group">

                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                 Update Component
                                </button>
                            </div>
                        </div>

        <input type="hidden" name="component" value="{{ $component->id }}">

                    </form>
   
</form>

@endsection