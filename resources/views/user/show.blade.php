@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">
            
            <h3>{{$user->firstName}} {{$user->lastName}}</h3>
            <h5>Student Portfolio</h5>
            
            </div>
            
            <div class="panel-body">
            
                    @foreach ($user->artifacts as $artifact) 

                    <div class="pull-left project-wrapper">
                     
                        <a href="{{ action('ArtifactController@show', $artifact->id)}}">                    

                        <img class="img-responsive" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}"></a>

                    <br/>
                    <i>{{ $artifact->title}}</i><br/>
                    {{ $artifact->medium}}<br/>
                    {{ $artifact->dimensions_height}} x {{ $artifact->dimensions_width}}

                    @if ($artifact->dimensions_depth)
                
                   x {{ $artifact->dimensions_depth }}
                
                   @else
                   @endif
                        
                    {{ $artifact->dimensions_units }}
                    
                    <br/>
                    </div>

                    @endforeach

            </div>                    
            </div>

            </div>
        </div>
    </div>
</div>
@endsection

