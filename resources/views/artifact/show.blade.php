@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
	     <div class="col-xs-5 col-sm-6 col-md-8 col-lg-9">

            <a href="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}"><img class="img-responsive" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}"></a><br>

        </div>

		<div class="col-md-4 col-lg-3">

		<b>Artist:</b> {{ $artifact->user->firstName }} {{ $artifact->user->lastName }}<br/>

    <b>Assignment:</b> <a href="{{ action('AssignmentController@show', $artifact->assignment_id )}}">{{ $artifact->assignment->title }}</a><br/>
    <b>Component:</b> {{ $artifact->component->title }}<br/>

    <b>Status:</b> 

          @if ($artifact->is_published)

        Published to Portfolio
        
        @else

        Unpublished

        @endif

    <br/>

    @if ($artifact->is_published)

        <b>Title:</b> <i>{{ $artifact->title }}</i><br/>
        <b>Medium:</b> {{ $artifact->medium }}<br/>
        <b>Dimensions:</b> {{ $artifact->dimensions_height }} x {{ $artifact->dimensions_width }}
      
          @if ($artifact->dimensions_depth)
        
            x {{ $artifact->dimensions_depth }}
        
          @else


        @endif

              {{ $artifact->dimensions_units }}<br/><br/>

        <b>Gallery Text:</b> {{ $artifact->description }}<br>

      
        <hr/>
        
    
        
        <br/><br/>

        <a class="btn btn-primary" href='{{ action('ArtifactController@edit', $artifact->id) }}'>Edit</a>

		    <hr/>

        <a class="btn btn-warning" href='{{ action('ArtifactController@unpublish', $artifact->id) }}'>Remove this from my portfolio</a><br/>
      	
      	@else

        <br/> <a class="btn btn-primary" href='{{ action('ArtifactController@edit', $artifact->id) }}'>Add this to my portfolio</a><br/>

      	@endif

        <a class="btn btn-primary" href='{{ action('ArtifactController@rotate', $artifact->id) }}'>Rotate Image</a>

        <hr/>        

	    	</div>

    </div>
</div>
                    
@endsection