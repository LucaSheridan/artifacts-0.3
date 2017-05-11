@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                
                <p>Are you sure you want to Delete {{ $project->title }}?</p>

                
                <div class="submit-button-container">

                <ul class="list-inline">                
                <li>

                {!! Form::open(['action' => ['ProjectController@show', $project->id], 
                                'method' => 'Get',
                                'class' => 'btn btn-primary']) !!}
                {!! Form::submit('Cancel') !!}
                {!! Form::close() !!}

                </li>
                 <li> 

                {!! Form::open(['action' => ['ProjectController@destroy', $project->id], 
                                'method' => 'Delete',
                                'class' => 'btn btn-danger']) !!}
                {!! Form::submit('Delete') !!}
                {!! Form::close() !!}
                
                </li>
                </ul>

                </div>
        </div>
    </div>
</div>
                    
@endsection