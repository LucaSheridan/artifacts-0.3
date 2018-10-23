@extends('layouts.app')

@section('content')

          
<div class="container ">
<div class="row well">
    
        <!-- Begin Classes -->

                <div class="col-md-12">

                <span class="pull-right">
                <a class="" href='{{ action('SectionController@edit', $section->id) }}'>Edit</a>    
                </span>
                
                <h4>CLASSES</h4>

                <ul class="list-inline">

                    @foreach ( Auth::User()->sections as $section) 
                        
                        @if ( $section->active )

                             <li> <a class="btn {{active_check('section/'.$section->id)}}" href="{{action('SectionController@show', $section->id)}}">{{ $section->label}}</a>
                             </li>

                        @else
                        @endif

                    @endforeach
                
                  </ul>
                  <hr/>

              </div>

        <!-- End Classes --> 

<!-- End row --> 
                                
          <!-- Students -->
          <div class="col-md-6">
          <h4>STUDENTS ({{ count($roster) }})</h4>
                            
          <!-- Roster -->
          <div class="panel panel-default">
          
          <div class="panel-heading">

                                    @if ($roster->count() == 0)
                                    
                                    <p>There are currently no students enrolled in this section.</p>

                                    @else

                                        @foreach ($roster as $rosterspot)
                                        
                                        <a href="{{ action('SectionController@progressReport', ['section' => $section->id, 'user' => $rosterspot->id])}}">

                                        {{ $rosterspot->firstName}} {{ $rosterspot->lastName}}</a> ({{count( $rosterspot->artifacts)}})

                                        <span class="pull-right">
                                        
                                        <a href="mailto:{{$rosterspot->email}} ">Email</a> | <a href="{{ action('UserController@show', $rosterspot->id) }}">Portfolio</a>
                                        
                                        </span><br/>

                                        @endforeach

                                    @endif
                                                               
         </div>

         <div class="panel-body">Class Enrollment Code: {{$section->code}}
         </div>

        </div>

        </div>

                           
<!-- Students -->
          <div class="col-md-6">
          <h4>ASSIGNMENTS</h4>

          
                            
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
