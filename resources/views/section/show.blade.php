@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-default">
               
                <div class="panel-heading">
                {{$section->label}}
                <span class='pull-right'>Registration code: {{$section->code}}</span><br/>
                
                <span class='pull-right'><a href="{{ action('SectionController@classProgressReport', ['section' => $section->id, 'users' => $section->students ])}}">Heat Map</a></span>
                

                </span>
                </div>

                <div class="panel-body">
                
                    <div class="row">
                        <div class="col-md-12">

                            <ul class="nav nav-tabs">

                            <li class="active"><a data-toggle="tab" href="#students">Students ({{ count($roster) }})</a></li>
                            <li><a data-toggle="tab" href="#assignments">Assignments</a></li>
                           
                            </ul>

                            <div class="tab-content">
                
                                {{-- Begin Roster --}}

                                <div id="students" class="tab-pane fade in active clearfix">
                                
                                    @if ($roster->count() == 0)
                                    
                                    <p>There are currently no students enrolled in this section.</p>

                                    @else

                                        @foreach ($roster as $rosterspot)

                                        <div class="pull-left project-wrapper">
                                        
                                              <b>{{ $rosterspot->firstName}} {{ $rosterspot->lastName}}</b> 

                                              <a href="{{ action('UserController@show', $rosterspot->id)}}">Portfolio</a> | 

                                              <a href="{{ action('SectionController@progressReport', ['section' => $section->id, 'user' => $rosterspot->id])}}">Progress Report</a>

                                        </div><br/>

                                                @endforeach

                                    @endif

                                                            
                                </div>

                                {{-- Begin Assignments --}}

                                <div id="assignments" class="tab-pane fade  clearfix">
                
                                    @if ($assignments->count())
            
                                    @foreach ($assignments as $assignment)
                     
                                        <div class="pull-left project-wrapper">
                                        <div class="well">

                                        <a href='{{ action('SectionController@ViewClassAssignment', ([$section->id, $assignment->id ])) }} '>{{ $assignment->title }}</a> | 
                                        <a href='{{ action('AssignmentController@show', $assignment->id) }} '>Edit</a> 
                                        

                                        </div>
                                        </div>
                                                                    
                                        @endforeach

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
@endsection
