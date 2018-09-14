@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-default">
               
                <div class="panel-heading">
                {{$section->label}}
                <span class='pull-right'>Registration code: {{$section->code}}</span><br/>
                
               <!--  HEAT MAP 
               <span class='pull-right'><a href="{{ action('SectionController@classProgressReport', ['section' => $section->id, 'users' => $section->students ])}}">Heat Map</a></span>
                 -->

                </span>
                </div>

                <div class="panel-body">
                
                    <div class="row">
                        
                        <div class="col-md-12">

                            <div class="col-md-6">

                                
                            <!-- HEADING -->
                            
                            <h3>Students ({{ count($roster) }})</h3><br/>
                            
                            <!-- BEGIN PANEL -->
                            
                             <div class="panel panel-default">

                            
                            <div class="panel-heading">

                                 {{-- Begin Roster --}}

                                @if ($roster->count() == 0)
                                    
                                    <p>There are currently no students enrolled in this section.</p>

                                    @else

                                        @foreach ($roster as $rosterspot)
                                        
                                              <a href="{{ action('SectionController@progressReport', ['section' => $section->id, 'user' => $rosterspot->id])}}">{{ $rosterspot->firstName}} {{ $rosterspot->lastName}}</a>

                                                <br/>

                                                @endforeach

                                    @endif
                                                               
                                </div></div></div>

                            <div class="col-md-6">

                            <h3>Assignments</h3><br/>
                           

                                {{-- Begin Assignments --}}

                                @if ($assignments->count())
            
  
 @foreach ($assignments as $assignment)

                                        
 <!-- BEGIN PANEL -->
 <div class="panel panel-default">
    
    <!-- HEADING -->
    <div class="panel-heading">
        <a href="{{ action('AssignmentController@show', $assignment->id) }}">
          
          {{ $assignment->title }}</a> | 

          <a href='{{ action('SectionController@ViewClassAssignment', ([$section->id, $assignment->id ])) }}'>Gallery</a> | 
  
          <a href='{{ action('AssignmentController@edit', $assignment->id) }} '>Edit</a>

    </div>
    
    <!-- DESCRIPTION -->
   
        <div id="collapse{{$assignment->id}}" class="panel-collapse collapse in">
        <div class="panel-body">
        
        <!-- Components -->

        @foreach  ($assignment->components as $component) 

            - <a href='{{action('SectionController@AssignmentComponent', ['section' => $assignment->section->id, 'assignment' => $component->assignment_id, 'component' => $component->id])}}'>{{ $component->title }}</a>

            <span class="pull-right">
            Due {{ Carbon\Carbon::parse($component->date_due)->setTimezone('America/New_York')->format('D n/j') }}</span>

            <br/>

        @endforeach

        </div>
        </div>
    </div>

      <!-- End Panel -->


                                                                     
                                        @endforeach


                                        <br/>

                                    @else
                                    
                                    <p>No Assignments have been created yet.</p>
                                    
                                    @endif  

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
                                    
                                
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
