@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               
            <div class="panel-heading">Create New Section</div>
            <div class="panel-body">
        
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/section') }}">
                    
                    {!! csrf_field() !!}

                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">

                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                            
                                <label class="col-md-4 control-label">Label</label>

                                <div class="col-md-6">

                                    {!! Form::text('label', null, ['class' => 'form-control']) !!}

                                    @if ($errors->has('label'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('label') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                            
                                <label class="col-md-4 control-label">Site</label>

                                <div class="col-md-6">

                                    {!! Form::select('site', $sites, ['class' => 'form-control']) !!}

                                    @if ($errors->has('site'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('site') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <input type="hidden" name="teacher_id" value="{{ Auth::User()->id }}">


                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                         Submit
                                    </button>
                                </div>
                        </div>
                
                    </form>

            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
