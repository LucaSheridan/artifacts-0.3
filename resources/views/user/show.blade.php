@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">
            
            <h3>{{$user->firstName}} {{$user->lastName}}</h3>
            <h5>Art Portfolio</h5>
            
            </div>
            
            <div class="panel-body">
            
                    @foreach ($user->projects as $project) 
                    
                    <div class="pull-left">
 
                    <a href="{{ action('ProjectController@show', $project->id)}}">
                    <img src ='{{ url($project->primaryArtifactThumb) }}'></a>
                    <br/>
                    {{ $project->title}}<br/>
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

