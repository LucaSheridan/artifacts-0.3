@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">
            
            <h3>{{$user->firstName}} {{$user->lastName}}</h3>
            <h5>Art Portfolio <a href="mailto:{{$user->email}}">

            <span class="glyphicon glyphicon-envelope"></span></a></h5>
            

            
            </div>
            
            <div class="panel-body">
            
                    @foreach ($user->projects as $project) 
                    
                    <div class="pull-left project-wrapper">
 
                    <a href="{{ action('ProjectController@show', $project->id)}}">
                    
                         @if ($project->primaryArtifactThumb)
                    
                         <img src ='{{ url($project->primaryArtifactThumb) }}'><br>
                    
                         @else
                        
                         <div class='project-placeholder'>
                         <span class='project-placeholder-text'>In Progress</span>
                         </div>
                        
                        @endif
                    </a>

                    <br/>
                    <i>{{ $project->title}}</i><br/>
                    {{ $project->medium}}<br/>
                    {{ $project->dimensions}}<br/>
                    </div>

                    @endforeach

                    
            </div>

            </div>
        </div>
    </div>
</div>
@endsection

