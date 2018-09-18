@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-heading">Add a Class</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('addClass') }}" novalidate>
                        {{ csrf_field() }}

                        <div class="form-group">

                                <label for="code" class="col-md-4 control-label">Class Code</label>
                                <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required>

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                                <button type="submit" class="text-grey-lighter bg-grey-dark hover:bg-grey-darker hover:text-white hover:no-underline px-3 py-3 rounded">
                                Enroll in Class</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
             </div>
    </div>
</div>
@endsection
