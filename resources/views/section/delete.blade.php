@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                
                <p>Are you sure you want to delete {{ $section->name }}?</p>

                
                <ul class="list-inline">                
                <li>
                <a class="btn btn-default" href="{{ action('SectionController@show', $section->id) }}">Cancel</a>
                </li>
                 <li>
                
                {!! Form::open(['action' => ['SectionController@destroy', $section->id], 'method' => 'Delete']) !!}
                {!! Form::submit('Delete') !!}
                {!! Form::close() !!} 
                
                </li>
                </ul>

        </div>
    </div>
</div>
                    
@endsection