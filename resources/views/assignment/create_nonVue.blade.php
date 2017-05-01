@extends('layouts.app')

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

        <!-- Title-->

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Title</label>

                <div class="col-md-6">

                    {!! Form::text('title', null, ['class' => 'form-control']) !!}

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
        </div>

        <!-- Description -->

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Description</label>

                <div class="col-md-6">

                    {!! Form::text('description', null, ['class' => 'form-control']) !!}

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
        </div>

        <!-- Component Form -->

        <div class="form-group{{ $errors->has('components') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Components</label>

                    <div class="col-md-6">

                    {!! Form::text('components[]', null, ['class' => 'form-control']) !!}
                    {!! Form::text('components[]', null, ['class' => 'form-control']) !!}
                    {!! Form::text('components[]', null, ['class' => 'form-control']) !!}
                    {!! Form::text('components[]', null, ['class' => 'form-control']) !!}
                    {!! Form::text('components[]', null, ['class' => 'form-control']) !!}

                    @if ($errors->has('component'))
                        <span class="help-block">
                            <strong>{{ $errors->first('components') }}</strong>
                        </span>
                    @endif
                </div>
        </div>

        <!-- Due Date -->

        <div class="form-group{{ $errors->has('date_due') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date Due</label>

                <div class="col-md-3">

                {!! Form::date('date_due', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}

                    @if ($errors->has('date_due'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_due') }}</strong>
                        </span>
                    @endif
                </div>
        </div>

        <!-- Assigned Date -->

        <div class="form-group{{ $errors->has('date_assigned') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date Assigned</label>

                <div class="col-md-6">

                    {!! Form::date('date_assigned', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}

                    @if ($errors->has('date_assigned'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_assigned') }}</strong>
                        </span>
                    @endif
                </div>
        </div>

        <div class="form-group">
                            
                <div class="col-md-6 col-md-offset-4">
                    
                    <button type="submit" class="btn btn-primary">
                         Add Assignment
                    </button>

                </div>
        </div>
    
        </form>

@endsection

@section('scripts')

<!-- Javascript text for adding and subtracting component[] input fields -->

<!-- <script type="text/javascript">

                $(document).ready(function(){
                $("#addComponent").click(function(){
                      $("#component_inputs").append($("#template").html());
                  });
                
                $("#assignment_form").on("click", ".remove", function(){
                    $(this).parent().remove();
                });
            });
</script> -->

@section('scripts')
<script type="text/javascript">
if (typeof jQuery !== 'undefined') {  
    // jQuery is loaded => print the version
    alert(jQuery.fn.jquery);
}
</script>

@endsection

