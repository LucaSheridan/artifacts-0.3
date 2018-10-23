@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
	     <div class="col-md-12">
     
      <h1>{{ $collection->title}}</h1>
      
      <p>Collection curated by: 

      @foreach ($collection->curators as $curator)

     
      @if ($loop->first)
        
        {{ $curator->firstName }} {{ $curator->lastName }}
     

      @elseif ($loop->last)
        and {{ $curator->firstName }} {{ $curator->lastName }}

      @else , {{ $curator->firstName }} {{ $curator->lastName }}

      @endif
    



      @endforeach

      <hr/>

          @if ($collection->artifacts->count() > 0 )
            
          <!-- Loop Artifacts -->

          @foreach ($collection->artifacts as $artifact)

            <div class="pull-left project-wrapper">

            <div class="well">

            <a href="{{ action('ArtifactController@show', $artifact->id)}}">

            <img class="img-responsive" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}"> </a><br/>


            Position: {{ $artifact->pivot->position }}<br/>

            <!-- Artist -->
            @if ($artifact->firstName)<strong>Artist:</strong> {{ $artifact->user->firstName}} {{ $artifact->user->lastName}}<br/>
            @else
            @endif
            
            <!-- Title-->
            @if ($artifact->title)<strong>Title:</strong><i> {{ $artifact->title }}</i><br/>
            @else
            @endif

            <!-- Medium -->
            @if ($artifact->medium) <strong>Medium:</strong> {{ $artifact->medium }}<br/>
            @else
            @endif

            <!-- Dimensions -->
            @if ($artifact->dimensions_height && $artifact->dimensions_height)
                <strong>Dimensions:</strong> 
                  
                {{ $artifact->dimensions_height }} x {{ $artifact->dimensions_width }}
            
            @if ($artifact->dimensions_depth) x {{ $artifact->dimensions_depth }}
            @else
            @endif

            {{ $artifact->dimensions_units }}<br/>

            @else
            @endif
            
            <!-- <strong>Gallery Text:</strong> {{ $artifact->description }}<br> -->
          
            <a class="" href="{{ action('ArtifactController@removeFromCollection', ['artifact' => $artifact->id, 'collection' => $collection->id]) }}">Remove</a></div>
            </div>

          @endforeach

          </div>
        </div>


          @else
          
          <p>This collection is currently empty. Try adding some artifacts!</p>

          @endif

        </div>

      	</div>

    </div>
</div>
                    
@endsection