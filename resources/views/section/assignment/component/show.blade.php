@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row">
    

                <div class="col-md-3">

             
                <h4>{{ $assignment->title }}</h4>
                <p>Components</p>


                @foreach ( $assignment->components as $componentListItem )

                <a href="{{ action('SectionController@AssignmentComponent', [$section->id, $assignment->id, $componentListItem->id]) }}">

               <!--  {{ Carbon\Carbon::parse($componentListItem->date_due)->setTimezone('America/New_York')->format('n/j') }}   -->

                {{ $componentListItem->title }}</a><br/>

                @endforeach
 
                </div>

            

            <div class="col-md-9">
            <div class="panel panel-default">
               
            <div class="panel-heading">

            <a href="{{ action('SectionController@show', $section->id ) }}">{{ $section->label }}</a> |
            <a href="{{ action('SectionController@ViewClassAssignment', ['section' => $section->id,'assignment' => $assignment->id])}}">

            {{ $assignment->title }}</a>
            | Component: {{ $component->title }}</div>
            
            <div class="panel-body">                        
     
                       @foreach ( $students as $student )

                        <div class="component-wrapper">

                            <div class="component-owner">
                                
                                 <a href="{{ action('SectionController@StudentAssignmentProgressView', [ 'user' => $student->id , 'section' => $section->id , 'assignment' => $assignment->id ] )}}">
                                {{ $student->firstName}}<br/>
                                {{ $student->lastName }}</a>
                            </div>

                            <div class="component-display">

                                @forelse ($student->artifacts as $artifact)
                        
                                    @if (count($student->artifacts) > 1)
                            
                                    <div class="component-number-badge">
                                    <span class="badge">

                                        {{ $loop->iteration }}/{{ $loop->count }}
                                    

                                         </span>
                                    </div>

                                    @else
                                
                                    @endif

                                <a href="{{ action('ArtifactController@show', $artifact->id)}}"><img class="artifact-thumbnail" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}"></a>
                            
                                @empty
                        
                                <div class="component-missing">
                                No Artifacts Uploaded</p>
                                </div>
                                @endforelse
                    
                            </div>
                        
                        </div>
                       @endforeach


            </div>
            
            
            </div>

        </div>
    </div>
</div>
@endsection

