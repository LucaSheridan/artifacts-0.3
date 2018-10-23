@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               
            <div class="panel-heading">Start a new Collection</div>
            <div class="panel-body">
        
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/collection') }}">
                    
                    {!! csrf_field() !!}

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

                        <input type="hidden" name="curator_id" value="{{ Auth::User()->id }}">
                        <input type="hidden" name="artifact_id" value="{{ $artifact->id }}">

                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                         Create
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
