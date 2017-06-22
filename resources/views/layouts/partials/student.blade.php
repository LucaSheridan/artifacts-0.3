<div class="panel-heading">
    
<h3>{{Auth::User()->firstName}} {{Auth::User()->lastName}}</h3>
<h5>Art Portfolio </h5>
</div>

<div class="panel-body">
                    
    <p>Here are projects you have completed. Click the button below to begin a new project.</p>

 @foreach ($projects as $project) 
                        
                    <div class="pull-left project-wrapper">
 
                    <a href="{{ action('ProjectController@show', $project->id)}}">
                    
                         @if ($project->primaryArtifactThumb)
                    
                         <img src ='{{ url($project->primaryArtifactThumb) }}'><br>
                    
                         @else
                        
                         <div class='project-placeholder'>
                         <span class='project-placeholder-text'>
                         In Progress</span>
                         </div>
                        
                        @endif
                    </a>

                    <br/>
                    
                    <b>Title:</b> <i>{{ $project->title }}</i><br/>
                    <b>Medium:</b> {{ $project->medium }}<br/>
                    <b>Dimensions:</b> {{ $project->dimensions_height }} x 
                    {{ $project->dimensions_width }} 

                        @if (!$project->dimensions_depth)

                        @else

                            {{ 'x '.$project->dimensions_depth }}

                        @endif

                    {{ $project->dimensions_units }} 

                    <br/>

                    <b>Completed:</b> {{ $project->created_at->diffForHumans() }}<br/>
                    <b>Assignment:</b> {{ $project->assignment->title }}<br/>

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
            