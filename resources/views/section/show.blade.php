@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
        
            <div class="panel panel-default">
               





                    <div class="panel-heading">
                    <span class="pull-right"> <a href='{{action('SectionController@edit', $section->id )}}'>Edit</a></span>
                        <H4>{{$section->label}}</H4>
                 
               <!--  HEAT MAP 
               <span class='pull-right'><a href="{{ action('SectionController@classProgressReport', ['section' => $section->id, 'users' => $section->students ])}}">Heat Map</a></span>
                 -->

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
                                        
                                             <a href="{{ action('SectionController@progressReport', ['section' => $section->id, 'user' => $rosterspot->id])}}">

                                                {{ $rosterspot->firstName}} {{ $rosterspot->lastName}}</a> ({{count( $rosterspot->artifacts)}})

                                        <span class="pull-right">
                                        
                                        <a href="mailto:{{$rosterspot->email}} ">Email</a> | 

                                        <a href="{{ action('UserController@show', $rosterspot->id) }}">Portfolio</a>
                                        
                                        </span>

                                                <br/>

                                                @endforeach

                                    @endif
                                                               
                                </div>

                                    <div class="panel-body">Class Enrollment Code: {{$section->code}}</div>

                                </div></div>

                            <div class="col-md-6">

                                <h3>Assignments</h3><br/>
                           
                             <div class="panel panel-default">

                             <div class="panel-heading">
                            
                               {{-- Begin Assignments --}}

                                @if ($assignments->count())
            
  
 @foreach ($assignments as $assignment)

                                        
 <!-- BEGIN PANEL -->
 <div class="panel panel-default">
    
    <!-- HEADING -->
    <div class="panel-heading">
          
    {{ $assignment->title }}

    <!-- <a href='{{ action('SectionController@ViewClassAssignment', ([$section->id, $assignment->id ])) }}'>Gallery</a> -->    


    <div class="pull-right">
        <a href="{{ action('AssignmentController@show', $assignment->id) }}">
          Edit
        </a> 
    </div>
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

                                    @else
                                    
                                    <p>No Assignments have been created yet.</p>
                                    
                                    @endif  

                                    <a class='btn btn-primary pull-right' href='{{action('AssignmentController@create', $section->id) }}'>Create New Assignment</a>

                                    <div class="clearfix"></div>

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
</div>
@endsection
