@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        

                @foreach ($projects as $project)
                  
                <div class="media pull-left">

                      @if ($project->primaryArtifactThumb) 

                        <img src="{{ url($project->primaryArtifactThumb) }}"><br>

                         <p>
                    <b>Artist:</b> <i>{{ $project->user->firstName }} {{ $project->user->lastName }}</i><br/>
                    <b>Title:</b> <i>{{ $project->title }}</i><br/>
                    <b>Medium:</b> {{ $project->medium }}<br/>
                    <b>Dimensions:</b> {{ $project->dimensions }}<br/>
                    <b>Submitted:</b> {{ $project->created_at->diffForHumans() }}
                </p>  

                    @else


                    @endif



                @endforeach

                </div>
    </div>
</div>
                    
@endsection

