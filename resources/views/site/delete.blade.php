@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                
                <p>Are you sure you want to Delete {{ $site->name }}?</p>

                
                <ul class="list-inline">                
                <li>
                <a class="btn btn-default" href="{{ action('SiteController@show', $site->id) }}">Cancel</a>
                </li>
                 <li>
                
                {!! Form::open(['action' => ['SiteController@destroy', $site->id], 'method' => 'Delete']) !!}
                {!! Form::submit('Delete') !!}
                {!! Form::close() !!} 
                
                <!--<a class="btn btn-danger" href="{{ action('SiteController@destroy', $site) }}">Delete</a>-->

                </li>
                </ul>

        </div>
    </div>
</div>
                    
@endsection