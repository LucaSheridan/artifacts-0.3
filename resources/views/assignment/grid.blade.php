@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        

 @foreach ($projects as $project) 
    
        <div>
            <div class="media pull-left">

                <div class="media-left">

                    @if ($project->primaryArtifactThumb)

                   <a href="{{action ('ProjectController@show', $project->id )}}">
                        <img src ='{{ url($project->primaryArtifactThumb) }}'>
                   </a>

                    @else 

                    <a href="project/{{$project->id}}">
                        <div class='project-placeholder'>
                        <span class='project-placeholder-text'>Click Here to post images</span></div>
                    </a>

                    @endif
                    
                

                <!-- <div class="media-body"> -->
                
                    <br>
                    <p>
                    <b>Artist:</b> {{ $project->user->firstName }} {{ $project->user->lastName }}</i><br/>
                    <b>Title:</b> <i>{{ $project->title }}</i><br/>
                    <b>Medium:</b> {{ $project->medium }}<br/>
                    <b>Dimensions:</b> {{ $project->dimensions }}<br/>
                    <b>Submitted:</b> {{ $project->created_at->diffForHumans() }}
                    </p>
                <!-- </div> -->
               
            </div>
        </div>

    @endforeach
    </div>
</div>
                    
@endsection

