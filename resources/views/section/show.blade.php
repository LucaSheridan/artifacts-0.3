@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-default">
               
                <div class="panel-heading">
                {{$section->label}}
                <span class='pull-right'>Registration code: {{$section->code}}</span><br/>
                
               <!--  <span class='pull-right'><a href="{{ action('SectionController@classProgressReport', ['section' => $section->id, 'users' => $section->students ])}}">Heat Map</a></span>
                 -->

                </span>
                </div>

                <div class="panel-body">
                
                    <div class="row">
                        
                        <div class="col-md-12">

                            <div class="col-md-6">

                                <h3>Students ({{ count($roster) }})</h3>

                                 {{-- Begin Roster --}}

                                @if ($roster->count() == 0)
                                    
                                    <p>There are currently no students enrolled in this section.</p>

                                    @else

                                        @foreach ($roster as $rosterspot)
                                        
                                              <a href="{{ action('SectionController@progressReport', ['section' => $section->id, 'user' => $rosterspot->id])}}">{{ $rosterspot->firstName}} {{ $rosterspot->lastName}}</a>

                                                <br/>

                                                @endforeach

                                    @endif
                                                               
                                </div>

                            <div class="col-md-6">

                            <h3>Assignments</h3>
                           

                                {{-- Begin Assignments --}}

                                @if ($assignments->count())
            
                                    @foreach ($assignments as $assignment)

                                        {{ $assignment->title }} <a href='{{ action('SectionController@ViewClassAssignment', ([$section->id, $assignment->id ])) }}'>Gallery</a> | 
                                        <a href='{{ action('AssignmentController@show', $assignment->id) }} '>Edit</a><br/>

                                        @foreach  ($assignment->components as $component) 

                                            - <a href='{{action('SectionController@AssignmentComponent', ['section' => $assignment->section->id, 'assignment' => $component->assignment_id, 'component' => $component->id])}}'>{{ $component->title }}</a><br/>

                                        @endforeach
                                                                     
                                        @endforeach
                                        <br/>

                                    @else
                                    
                                    <p>No Assignments have been created yet.</p>
                                    
                                    @endif
                                    
                                
                                    <a class='btn btn-primary' href='{{action('AssignmentController@create', $section->id) }}'>Create New Assignment</a>

                                </div>
                            </div>


                            </div>
          
                        </div>
                    </div>
                </div>
            </div>         
        </div>
    </div>
</div>
@endsection
