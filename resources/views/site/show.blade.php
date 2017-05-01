@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
               
                <div class="panel-heading">{{$site->name}}</div>
                <div class="panel-body">
                This is where comprehensive information about {{$site->name}} will be included. It will probably take the form of a tabbed table that gives information about the number of teachers, students, sections, assignments and exhibitions that are associated with this site.
                </div>
            </div>
            
            <div class="panel panel-default">

                <div class="panel-heading">Sections</div>
                <div class="panel-body">
                @foreach ($site->sections as $section) 
                
                <a href="{{route('section.show', $section->id )}}">{{$section->name}} | {{$section->label}}</a> | {{$section->code}}<br/>

                    <!-- @foreach ($section->users as $user)

                        @if ($user->hasRole('teacher'))
                            {{ $user->firstname}}
                        @endif

                    @endforeach -->

                @endforeach
                </div>
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">Teachers</div>
                <div class="panel-body">
                @foreach ($site->users as $user) 
               
                        @if ($user->hasRole('teacher'))
                            
                            <a href="{{route('user.show', $user->id )}}">{{$user->firstName}} {{$user->lastName}}</a><br/>

                        @endif

                @endforeach
                </div>
            </div>
            <div class="panel panel-default">

                <div class="panel-heading">Students</div>
                <div class="panel-body">
                @foreach ($site->users as $user) 
               
                        @if ($user->hasRole('student'))
                            
                            {{$user->firstName}} {{$user->lastName}} 

                        @endif

                @endforeach
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

