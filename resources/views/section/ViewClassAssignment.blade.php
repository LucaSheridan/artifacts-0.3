@extends('layouts.app')

@section('content')

<div class="container">
    

<div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h4>Roster ({{ count($roster) }})</h4> 
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

            <a href="{{ action('SectionController@show', $section->id ) }}">{{ $section->label }}</a> |
            <a href="{{ action('SectionController@ViewClassAssignment', ['section' => $section->id,'assignment' => $assignment->id])}}">

            {{ $assignment->title }}</a>
            </div>



            <div class="panel-body">
            
            <p>Completed Projects</p>            

            @foreach ($students as $student)

            @foreach ($student->artifacts as $artifact)
        
        
                <div class="pull-left project-wrapper">

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

