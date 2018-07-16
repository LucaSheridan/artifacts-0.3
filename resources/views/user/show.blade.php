@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       
    <div class="panel col-12">
    <h3 class="text-center"> {{strtoupper($user->firstName)}} {{strtoupper($user->lastName)}}</h3>           <h4 class="text-center">PORTFOLIO</h4>            

           <div class="panel-body">

            
                    @foreach ($user->artifacts as $artifact) 

                    <div class="pull-left project-wrapper">
 
            <div class="well"><a href="{{ action('ArtifactController@show', $artifact->id)}}">
            
            <img src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}"></a>

            <br/>
            <br/>
        
            <i>{{ $artifact->title }}</i></a><br/>
            {{ $artifact->medium }}<br/>
            {{ $artifact->dimensions_height }} x 
            {{ $artifact->dimensions_width }} 

            @if ($artifact->dimensions_depth)
        
                x {{ $artifact->dimensions_depth }}
        
            @else
            @endif

                  {{ $artifact->dimensions_units }}<br/>
            
            <br/>

            </a>
        </div>

        </div>

                    @endforeach

            </div>                    
            </div>

</div>

            

            </div>
        </div>
    </div>
</div>
@endsection

