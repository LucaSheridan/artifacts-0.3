<div class="panel-heading">Student Dashboard</div>

<div class="panel-body">
                    
    <p>Welcome {{ Auth::User()->firstName }}, Here is your project portfolio, current classes and assignments. </p>
                    
            
    <b>Portfolio</b><br/>

    @foreach ($projects as $project) 
    
        <div>
            <div class="media">

                <div class="media-left">

                    @if ($project->primaryArtifactThumb)

                   <a href="project/{{$project->id}}">
                        <img src ='{{ $project->primaryArtifactThumb }}'>
                   </a>

                    @else 

                    <a href="project/{{$project->id}}">
                        <div class='project-placeholder'>
                        <span class='project-placeholder-text'>In progress</span></div>
                    </a>

                    @endif
                    
                </div>

                <div class="media-body">
                
                    <b>Title:</b> <i>{{ $project->title }}</i><br/>
                    <b>Medium:</b> {{ $project->medium }}<br/>
                    <b>Dimensions:</b> {{ $project->dimensions }}<br/>
                    <b>Submitted:</b> {{ $project->created_at->diffForHumans() }}<br/>
                
                </div>

               
            </div>
        </div><br/>

    @endforeach
    
</div></div>

<div>
    <a class="btn btn-primary" href ='{{ action('ProjectController@create') }}'>Create a New Project</a>
</div>


                    <!-- <table class="table">
                    <thead>
                    <tr>
                    <td>Class</td>
                    <td>Assignment</td>
                    <td>Due Date</td>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach ( Auth::User()->sections as $section) 

                    <tr>
                    <td><a href=''>{{ $section->label }}</a></td>
                    
                        <td>

                        @foreach ( $section->assignments as $assignment )

                            {{ $assignment->title}}<br/>
                        
                        @endforeach

                        </td>

                        <td>

                        @foreach ( $section->assignments as $assignment )

                            {{ $assignment->date_due}}<br/>
                        
                        @endforeach

                        </td>

                    </tr></tbody>
                     @endforeach 
                    
                    </table> -->
                    

                   

            </div>
            