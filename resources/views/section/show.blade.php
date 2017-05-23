@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">{{$section->name}}</div>

            <div class="panel-body">

            <p>Teacher: {{$teacher->firstName}} {{$teacher->lastName}}<br/>
               School: {{$section->site->name}}<br/> 
               Contact: {{$teacher->email}}<br/>
               Registration Code: {{$section->code}}
            </p>

           <!-- Delete Section-->

                  <div>       

                  {!! Form::open(['action' => ['SectionController@destroy', $section->id], 
                                  'method' => 'Delete']) !!}
                  {!! Form::submit('Delete Section', ['class' => 'btn btn-danger'])!!}
                  {!! Form::close() !!} 
                  
                  </div>

                <div class="row">
                
                <div class="col-sm-3">

                     <h4>Students ({{$students->count()}})</h4>

                     @if ($students->count() == 0)
            
            <p>There are currently no students enrolled in this section.</p>

            @else

            @foreach ($students as $student)
           
            {{ $loop->iteration }} <a href="{{ action('UserController@show', $student->id) }}">{{ $student->firstName}} {{ $student->lastName}}</a><br/>
            
            @endforeach

            @endif

                </div>

                <div class="col-sm-9">

                     <h4>Assignments ({{$assignments->count()}})</h4>

                </div>

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
