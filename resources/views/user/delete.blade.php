@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                
                <p>Are you sure you want to Delete {{ $user->name }}?</p>

                
                <ul class="list-inline">                
                <li>
                <a class="btn btn-default" href="{{ action('UserController@index') }}">Cancel</a>
                </li>
                 <li>
                
                {!! Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'Delete']) !!}
                {!! Form::submit('Delete') !!}
                {!! Form::close() !!} 
                
                </li>
                </ul>

        </div>
    </div>
</div>
                    
@endsection