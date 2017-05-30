@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        

                @foreach ($projects as $project)
                  
                    @if ($project->primaryArtifactThumb) 

                    <img src="{{ url($project->primaryArtifactThumb) }}"><br>

                    @else


                    @endif

                {{ $project->title }}<br/>

                @endforeach
    </div>
</div>
                    
@endsection