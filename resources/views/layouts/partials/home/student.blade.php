
<div class="container">
    
    <div class="panel col-12">
    <h3 class="text-center mt-2">{{ strtoupper(Auth::User()->firstName.' '.Auth::User()->lastName) }}</h3>
    </div>

<div class="col-md-3 col-lg-3">




<!--         <p>
        Click on links to upload images.
        </p><br/>
 -->
        <!-- Loop Classes -->

        <h4>Classes</h4>

        @foreach (Auth::User()->sections as $section) 
        
        <br/><h5>{{$section->name}}</h5>                
     
           @foreach ($section->assignments as $assignment)

            <!-- Toggle Components -->

    
            <!-- Link to Assignment Process Page -->

            <a href="{{ action('AssignmentController@show', $assignment->id )}}">
            {{ $assignment->title}}<br/>
            </a>

           @endforeach
                                                     
        @endforeach

<br/>
<a href="{{ url('/enroll')}}">Join another class</a><br/>

</div>

<div class="col-md-9 col-lg-9">

<h4>PORTFOLIO</h4>
                    
<p>Completed and published projects.</p>
  
            <div class="flex flex-wrap bg-grey-lighter mt-4">
                            
            @foreach ($artifacts as $artifact) 

            <div class="flex-col items-center justify-around w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/4 
            bg-white text-grey-darker text-md items-center justify-around">
           
                <a href="{{ action('ArtifactController@show', $artifact->id)}}">
                <img class="block max-w-full m-4 h-auto p-2" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}"></a>
            

            
<!--        <div class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/4 text-grey-darker text-center bg-grey-light px-4 py-2 m-2">
 -->            
            

<!--          <div class="pull-left project-wrapper">
 --> <!-- 
            <div class="well"> -->

            <!-- <a href="{{ action('ArtifactController@show', $artifact->id)}}">
            
            <img src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}"></a>
 -->        
           <div class="leading-tight p-2">

            <i>{{ $artifact->title }}</i><br/>
            {{ $artifact->medium }}<br/>
            {{ $artifact->dimensions_height }} x 
            {{ $artifact->dimensions_width }} 

            @if ($artifact->dimensions_depth)
        
                x {{ $artifact->dimensions_depth }}
        
            @else
            @endif

                  {{ $artifact->dimensions_units }}
            
            </div>

 

        </div>

    @endforeach
</div>
    </div> 

</div>

</div>

<br/>






              