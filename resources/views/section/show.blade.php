@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">{{$section->name}}
            <span class="pull-right">{{$teacher->firstName}} {{$teacher->lastName}}</span><br/>
            <span class="pull-left">{{$section->site->name}}</span>
            <span class="pull-right">{{$teacher->email}}</span>

            </div>

            <div class="panel-body">

            <p>Teacher: {{$teacher->lastName}}<br/>
               School: {{$section->site->name}}<br/> 
               Contact: {{$teacher->email}}<br/>
               Registration Code: {{$section->code}}
            </p>

                
            <div class="row">
                
            <!-- Student List -->

            <div class="col-sm-3">

            <h4>Students ({{$students->count()}})</h4>

                @if ($students->count() == 0)
                
                <p>There are currently no students enrolled in this section.</p>

                @else

            @foreach ($students as $student)
           
            <!-- {{ $loop->iteration }} -->

            <a href="{{ action('UserController@show', $student->id) }}">{{ $student->firstName}} {{ $student->lastName}}</a><br/>
            
            @endforeach

            @endif

            </div>

            <!-- Assignment List -->

            <div class="col-sm-9">

            <h4>Assignments ({{$assignments->count()}})</h4>

                
                @if ($assignments->count())
    
                    @foreach ($assignments as $assignment)
                   
                    <!-- {{ $loop->iteration }} -->                           
                    
                    {{ $assignment->date_due }} | <a href='{{action('AssignmentController@grid', $assignment->id)}}'>{{ $assignment->title }}</a><br/>
                                                
                    @endforeach

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
