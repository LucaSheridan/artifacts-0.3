@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row">
        
        <div class="col-md-12">

        <div class="panel panel-default">
        <div class="panel-heading">

         <h2>{{ $section->name }} | {{ $assignment->title }}</h2>
        <h4>Class Assignment View</h4>

        </div>
        </div>
        </div>
        </div>

    <div class="row">

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
            Roster
            </div> 
            
            <div class="panel-body">

            @foreach ($roster as $rosterspot)


                <a href="{{ action('SectionController@StudentAssignmentProgressView', ['$section' => $section->id, '$assignment' => $assignment->id, '$student' => $rosterspot->id])}}">
                {{$rosterspot->firstName}} {{$rosterspot->lastName}}</a><br/>

            @endforeach

            </div>
        </div>
    </div>

    <div class="col-md-9">
            <div class="panel panel-default">
            <div class="panel-heading">
            Completed Projects            
            </div>  

            <div class="panel-body">
            
            @foreach ($students as $student)

            @foreach ($student->artifacts as $artifact)
        
        
                <div class="pull-left project-wrapper">

                <a href="{{ action('SectionController@StudentAssignmentProgressView', ['$section' => $section->id, '$assignment' => $assignment->id, '$student' => $student->id])}}">
                {{$student->firstName}} {{$student->lastName}}</a><br/>


                <a href="{{ action('ArtifactController@show', $artifact->id)}}">
                <img  src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}">
                </a>

                <p>
                <i>{{ $artifact->title }}</i><br/>
                   {{ $artifact->medium }}<br/>
                   {{ $artifact->dimensions_height }} x 
                   {{ $artifact->dimensions_width }} 

                   @if ($artifact->dimensions_depth)
                
                   x {{ $artifact->dimensions_depth }}
                
                   @else
                   @endif
                        
                    {{ $artifact->dimensions_units }}
                </p>
                </div>
        
                @endforeach

            @endforeach

            </div>
            </div>
            </div>


                    
@endsection

