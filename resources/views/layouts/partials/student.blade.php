
<div class="container">
    
    <div class="panel col-12">
    <h3 class="text-center">Auth::User()->firstName</h3>
    </div>

<div class="panel col-md-4 col-lg-4">

    @foreach ( Auth::User()->sections as $section) 
                        
        <b>{{ $section->name}}</b><br/>

        @foreach ($section->assignments as $assignment)

           <a href="{{ action('AssignmentController@show', $assignment->id )}}">
           {{ $assignment->title}} </a><br/>

        @endforeach
                                                     
    @endforeach


</div>

<div class="panel col-md-8 col-lg-8">
                    
<p>Here is a portfolio of assignments you have completed. Click on assignment links to post more artifacts for class.</p>

    @foreach ($artifacts as $artifact) 
            
        <div class="pull-left project-wrapper">

            <a href="{{ action('ArtifactController@show', $artifact->id)}}">
            
                <img class="img-responsive" src ='{{ url($artifact->artifact_thumb) }}'><br>
                
            

            <br/>
        
            <i>{{ $artifact->title }}</i><br/>
            {{ $artifact->medium }}</a><br/>
            {{ $artifact->dimensions_height }} x 
            {{ $artifact->dimensions_width }} {{ $artifact->dimensions_units }}<br/>
<br/>

            <br/>
            <br/>

            </a>

        </div>

    @endforeach
  
</div>

</div>







              