@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        Project: {{ $artifact->project_id }}<br/>
        User: {{ $artifact->user_id }}<br/>
        Assignment: {{ $artifact->assignment_id }}<br/>
        Project: {{ $artifact->component_id }}<br/><br/>
        <img src="{{ url($artifact->artifact_path) }}">

    
    </div>
</div>
                    
@endsection