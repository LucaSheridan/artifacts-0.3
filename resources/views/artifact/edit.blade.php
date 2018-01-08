@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Publish Artifact</div>
                <div class="panel-body">


         <!-- Begin Form --> 

        <form class="form-horizontal" role="form" method="POST" action="{{ action('ArtifactController@publish', $artifact->id) }}" enctype="multipart/form-data">

            {!! csrf_field() !!}

            <input type="hidden" name="_method" value="PATCH">

        <!-- Title Input -->

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                
                {!! Form::label('title', 'Artwork Title', array('class' => 'col-md-2 control-label')) !!}

                <div class="col-md-8">
            
                <input type="text" class="form-control" name="title" value="{{ $artifact->title }}">

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif

                </div>
            </div>

         <!-- Medium Input -->

            <div class="form-group{{ $errors->has('medium') ? ' has-error' : '' }}">
                                
                {!! Form::label('medium', 'Medium', array('class' => 'col-md-2 control-label')) !!}

                <div class="col-md-8">
            
                <input type="text" class="form-control" name="medium" value="{{ $artifact->medium }}">

                        @if ($errors->has('medium'))
                            <span class="help-block">
                                <strong>{{ $errors->first('medium') }}</strong>
                            </span>
                        @endif
                </div>
            </div>        



            <div class="form-horizontal">

           <!-- Dimensions Height Input -->

            <div class="form-group{{ $errors->has('dimensions_height') ? ' has-error' : '' }}">
                                
                {!! Form::label('dimensions_height', 'Height', array('class' => 'col-md-2 control-label')) !!}

                <div class="col-md-2">
            
                <input type="text" class="form-control" name="dimensions_height" value="{{ $artifact->dimensions_height }}">

                        @if ($errors->has('dimensions_height'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dimensions_height') }}</strong>
                            </span>
                        @endif
                </div>
            </div>       

            <!-- Dimensions Width Input -->

            <div class="form-group{{ $errors->has('dimensions_width') ? ' has-error' : '' }}">
                                
                {!! Form::label('dimensions_width', 'Width', array('class' => 'col-md-2 control-label')) !!}

                <div class="col-md-2">
            
                <input type="text" class="form-control" name="dimensions_width" value="{{ $artifact->dimensions_width }}">

                        @if ($errors->has('dimensions_width'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dimensions_width') }}</strong>
                            </span>
                        @endif
                </div>
            </div>       

            <!-- Dimensions Depth Input -->

             <div class="form-group{{ $errors->has('dimensions_depth') ? ' has-error' : '' }}">
                                
                {!! Form::label('dimensions_depth', 'Depth', array('class' => 'col-md-2 control-label')) !!}

                <div class="col-md-2">
            
                <input type="text" class="form-control" name="dimensions_depth" value="{{ $artifact->dimensions_depth }}">

                        @if ($errors->has('dimensions_depth'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dimensions_depth') }}</strong>
                            </span>
                        @endif
                </div>
            </div> 

            <!-- Dimensions Units -->


            <div class="form-group{{ $errors->has('dimensions_units') ? ' has-error' : '' }}">
                                
                {!! Form::label('dimensions_units', 'Units', array('class' => 'col-md-2 control-label')) !!}
                

                <div class="col-md-2">
            
                {!! Form::select('dimensions_units', ['inches' => 'inches', 'cm' => 'cm'], $artifact->dimensions_units, ['class' => 'form-control','value' => $artifact->dimensions_units]) !!}
                
                        @if ($errors->has('dimensions_units'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dimensions_units') }}</strong>
                            </span>
                        @endif
                </div>
            </div>  


            <!-- Description Input -->

             <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                
                {!! Form::label('description', 'Gallery Text', array('class' => 'col-md-2 control-label')) !!}

                <div class="col-md-8">

                {{ Form::textarea('description', $artifact->description, ['class' => 'form-control', 'size' => '70x5']) }}
            

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                </div>
            </div> 

        <!-- Update Button -->

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                 Add Artifact to My Portfolio
                </button>
            </div>
        </div>

        </div> 
        </div>


       
</form>

@endsection