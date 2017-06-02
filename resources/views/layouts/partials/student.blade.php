<div class="panel-heading">Portfolio</div>

<div class="panel-body">
                    
    <p>Here are projects you have completed. Click the button below to begin a new project.</p>

 @foreach ($projects as $project) 
    
        <div>
            <div class="media pull-left">

                <div class="media-left">

                    @if ($project->primaryArtifactThumb)

                   <a href="project/{{$project->id}}">
                        <img src ='{{ $project->primaryArtifactThumb }}'>
                   </a>

                    @else 

                    <a href="project/{{$project->id}}">
                        <div class='project-placeholder'>
                        <span class='project-placeholder-text'>Click Here to post images</span></div>
                    </a>

                    @endif
                    
                    <p>
                    <b>Title:</b> <i>{{ $project->title }}</i><br/>
                    <b>Medium:</b> {{ $project->medium }}<br/>
                    <b>Dimensions:</b> {{ $project->dimensions }}<br/>
                    <b>Submitted:</b> {{ $project->created_at->diffForHumans() }}
                    </p>
              
              </div>
            </div>
        </div>

    @endforeach


    
    </div>

    <div class="panel-footer">
    <a class="btn btn-primary" href ='{{ action('ProjectController@create') }}'>Create a New Project</a>
    </div>  

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
            