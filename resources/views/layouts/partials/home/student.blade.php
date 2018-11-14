
<div class="container">
    
    <div class="panel col-12">
    
    <h3 class="mt-2 text-center">{{ strtoupper(Auth::User()->firstName.' '.Auth::User()->lastName) }}</h3>
    
    </div>

<!-- Left Column -->

<div class="col-md-12 visible-sm visible-xs">
    <div class="well">

        <h4>ASSIGNMENTS</h4>

        <select class="form-control" onchange="location = this.value;">
        
        <option value="">Choose an assignment ...</option>

        @foreach (Auth::User()->sections as $section)

          <optgroup label="{{$section->name}}">

            @foreach ($section->assignments as $assignment)

                <option value="{{action('AssignmentController@show', $assignment->id) }}">

                    {{$assignment->title}}

            @endforeach

          </optgroup>

        @endforeach

        </select>

    </div>
</div>


<div class="col-md-3 col-lg-3 hidden-sm hidden-xs">

    <div class="well">

     <h4>ASSIGNMENTS</h4>
        
    <!-- Loop Classes -->

        @foreach (Auth::User()->sections as $section) 
             
        <strong>{{$section->label}}</strong><br/>

        @foreach ($section->assignments as $assignment)

           <!-- Link to Assignment Process Page -->

            - <a style="margin-left:10px; text-decoration:none; color:black" href="{{ action('AssignmentController@show', $assignment->id )}}">
            {{ $assignment->title}}
            </a><br/>
            
           
           @endforeach  

        @endforeach

    </div>

</div>

<!-- Center Column -->

<div class="col-md-9 col-lg-9">

    <!-- Begin Artifacts -->

        <div class="well">

        <h4>ARTIFACTS</h4>
        <p>A stream of images that document your creative projects</p>

            <div class="" style="display: flex; flex-wrap: wrap;">

            @foreach ($artifacts as $artifact)
 
                <div class="" style="padding:12px;">

                <a href="{{ action('ArtifactController@show', $artifact->id )}}">
                
                <img class="img-responsive" src="https://s3.amazonaws.com/artifacts-0.3/{{ $artifact->artifact_thumb}}"></a>

                </div>

            @endforeach

            </div>

        </div>

    <!-- End Artifacts -->

<div>

   

<div class="clearfix"></div>
</div>

</div>



</div>

</div>

<br/>





              