@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">
            {{$section->label}}<span class='pull-right'>Registration code: {{$section->code}}</span>
            
            </div>

            <div class="panel-body">
                
            <div class="row">
                
            <!-- Student List -->

            <div class="col-sm-3">

            <h4>Roster</h4>

                @if ($roster->count() == 0)
                
                <p>There are currently no students enrolled in this section.</p>

                @else

            @foreach ($roster as $rosterspot)
           
            <!-- {{ $loop->iteration }} -->

            <a href="{{ action('UserController@show', $rosterspot->id) }}">{{ $rosterspot->firstName}} {{ $rosterspot->lastName}}</a><br/>
            
            @endforeach

            @endif

            </div>

            <!-- Assignment List -->

            <div class="col-sm-9">

            <h4>Assignments</h4>

                
                @if ($assignments->count())
    
                    @foreach ($assignments as $assignment)
             
                    {{ $assignment->title }} | 
                    <a href='{{ action('AssignmentController@show', $assignment->id) }} '>Edit</a> | 
                    <a href='{{ action('SectionController@ViewClassAssignment', ([$section->id, $assignment->id ])) }} '>View</a>

                    <br/>
                                                
                    @endforeach

                @else
                <p>No Assignments have been created yet.</p>
                @endif
                <br/>
                <a class='btn btn-primary' href='{{action('AssignmentController@create', $section->id) }}'>Create New Assignment</a>




            </div>
            </div>
            </div>
            </div>
            </div>

        </div>
    </div>
</div>
@endsection
