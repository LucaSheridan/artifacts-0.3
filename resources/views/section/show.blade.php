@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">{{$section->name}}</div>

            <div class="panel-body">

            <!-- Tabs-->

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#info">Info</a></li>
                <li><a data-toggle="tab" href="#students">Students ({{$students->count()}})</a></li>
                <li><a data-toggle="tab" href="#assignments">Assignments ({{$assignments->count()}})</a></li>
            </ul>
            
            <div class="tab-content">
              
                  <div id="info" class="tab-pane fade in active">
                      
                        <h3>Info</h3>
                        <p>Teacher: {{$teacher->firstName}} {{$teacher->lastName}}<br/>
                           School: {{$section->site->name}}<br/> 
                           Contact: {{$teacher->email}}<br/>
                           Registration Code: {{$section->code}}
                        </p>
                  
                  <!-- Delete Section-->

                  {!! Form::open(['action' => ['SectionController@destroy', $section->id], 
                                  'method' => 'Delete']) !!}
                  {!! Form::submit('Delete Section', ['class' => 'btn btn-danger'])!!}
                  {!! Form::close() !!} 
                  
                  </div>

                  

                  <div id="students" class="tab-pane fade">

                        <h3>Students</h3>

            <table class='table'>
            
            @if ($students->count() == 0)
            
            <tr><td>There are currently no students enrolled in this section.</td></tr>

            @else

            @foreach ($students as $student)
           
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                <a href='{{ action('UserController@show', $student->id) }}'>{{ $student->firstName}} {{ $student->lastName}}</a>
                </td>
                 <td>
                </td>
            </tr>
            
            @endforeach

            @endif

            </table>

    </div>
              
                  <div id="assignments" class="tab-pane fade">
                                   
                  <h3>Assignments</h3>
@if ($assignments->count())

            <table class='table'>
            
            <thead>
            <tr>
                <td>
                </td>
                <td>
                Title
                </td>
                <td>Due Date</td>
                <td>Components</td>
            </tr>
            </thead>
            
            @foreach ($assignments as $assignment)
           
            <tr>
                <td>{{ $loop->iteration }}
                </td>
                <td>
                <a href='{{action('AssignmentController@show', $assignment->id)}}'>{{ $assignment->title }}</a>
                </td>
                 <td>
                {{ $assignment->date_due }}
                </td>
                
                <!-- Components-->
                
                <td>
                
                <!-- this is wrong, as it used lazy loading -->
               
                @foreach ($assignment->components as $component)
                {{ $component->title }}<br/>
                @endforeach 
                
                </td>
            </tr>
            
            @endforeach

            </table>



@else
@endif

<a class='btn btn-primary' href='{{action('SectionController@createAssignment', $section->id) }}'>Create Assignment</a>




            </div>
            </div>
            </div>
            </div>
            </div>

        </div>
    </div>
</div>
@endsection
