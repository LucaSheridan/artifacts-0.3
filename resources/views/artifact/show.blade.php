@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
	     <div class="col-md-8 col-lg-6">

            <img class="img-responsive" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_path}}"><br>

        </div>

		<div class="col-md-4 col-lg-4">

		<b>Artist:</b> {{ $artifact->user->firstName }} {{ $artifact->user->lastName }}<br/>
    <b>Assignment:</b> {{ $artifact->assignment->title }}<br/>
		<b>Component:</b> {{ $artifact->component->title }}<br/>

		<b>Status:</b> 

	        @if ($artifact->is_published)

	    	Published
	    	
	    	@else

	    	Unpublished

	    	@endif


		<hr/>

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



      	<a class="btn btn-primary" href='{{ action('ArtifactController@unpublish', $artifact->id) }}'>Unpublish</a><br/>
      	
      	@else

        <a class="btn btn-primary" href='{{ action('ArtifactController@edit', $artifact->id) }}'>Publish</a><br/>
<br/>

      	@endif

        <hr/>

		 <ul class="list-inline">                
                <li>
                  <a class="btn btn-primary" href='{{ action('ArtifactController@edit', $artifact->id) }}'>Edit</a><br/>
      	         </li>
                 <li>

		<a class="btn btn-danger" href='{{ action('ArtifactController@delete', $artifact->id) }}'>Delete</a><br/>
      </li>
   <!--    <li>
    <a class="btn btn-success" href='{{ action('ArtifactController@rotate', $artifact->id) }}'>Rotate</a><br/>
      </li>
 -->
      </ul>
      	</div>

    </div>
</div>
                    
@endsection