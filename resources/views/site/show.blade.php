@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                
                <div class="panel-heading">{{$site->name}}</div>
                <div class="panel-body">
                This is where comprehensive information about {{$site->name}} will be included. It will probably take the form of a tabbed table that gives information about the number of teachers, students, classes, assignments and exhibitions that are associated with this site.
                </div>
            </div>
            
            <div class="panel panel-default">

                <div class="panel-heading">Classes</div>
                <div class="panel-body">
                

                @if (!$site->sections)

                no classes

                @else 

                    @foreach ($site->sections as $section)

                    <a href="{{action('SectionController@show', $section->id)}}">{{ $section->label }} | {{ count($section->users) }} users</a><br/>

                    @endforeach

                @endif


                </div>
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">Teachers</div>
                <div class="panel-body">
                
                @if (!$site->users)

                no users

                @else 

                    @foreach ($site->users as $user) 
                   
                            @if ($user->hasRole('teacher'))
                                
                                <a href="{{action('UserController@show', $user->id )}}">{{$user->firstName}} {{$user->lastName}}</a><br/>

                            @endif

                    @endforeach

                @endif


                
                </div>
            </div>
            <div class="panel panel-default">

                <div class="panel-heading">Students</div>
                <div class="panel-body">
                @foreach ($site->users as $user) 
               
                        @if ($user->hasRole('student'))
                            
                            <a href="{{action('UserController@show', $user->id )}}">{{$user->firstName}} {{$user->lastName}}</a><br/>

                        @endif

                @endforeach
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

