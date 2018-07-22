
<div class="container">
    
    <div class="panel col-12">
    <h3 class="text-center">{{ strtoupper(Auth::User()->firstName.' '.Auth::User()->lastName) }}</h3>
    </div>

<div class="col-md-3 col-lg-3">

<h4>ASSIGNMENTS</h4>


        <p>
        Click on links to upload images.
        </p>

        @foreach ( Auth::User()->sections as $section) 

        <br/>
        {{ $section->students}}
        <br/>
                        
        @foreach ($section->assignments as $assignment)

        <!-- Toggle Components -->

        
        <a data-toggle="collapse" href="#toggleAssignment{{$assignment->id}}" aria-expanded="false" aria-controls="toggleAssignment{{$assignment->id}}">
        
        <span class="glyphicon glyphicon-triangle-right"></span>

        </a>
           
        <!-- Link to Assignment Process Page -->

        <a href="{{ action('AssignmentController@show', $assignment->id )}}">
        {{ $assignment->title}}<br/>
        </a>

        

    @endforeach
    <br/>
                                                     
    @endforeach


</div>

<div class="col-md-9 col-lg-9">

<h4>PORTFOLIO</h4>
                    
<p>Here is a portfolio of projects you have submitted as complete.</p>
  
    @foreach ($artifacts as $artifact) 
            
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
            {{ $artifact->description }}
        </div>

        </div>

    @endforeach

    </div> 

</div>

</div>

<br/>






              