<div class="panel-heading">Student Dashboard</div>

<div class="panel-body">
                    
    <p>Welcome {{ Auth::User()->firstName }}, Here is your project portfolio, current classes and assignments. </p>
                    
        <div class="panel panel-default">
            
            <div class="panel-heading">Portfolio</div>

            <div class="panel-body">
              
                <div class="table-responsive">

                    <table class="table">
                    <thead>
                      <tr>
                        <th>Artwork</th>
                        <th>Title</th>
                        <th>Assignment</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($projects as $project) 

                            
                        <tr>
                            <td>
                            
                            <a href="project/{{$project->id}}">
                            <img src ='{{ $project->primaryArtifactThumb }}'>
                            </a>

                            </td>

                            </td>
                            <td><a href="project/{{$project->id}}">{{ $project->title }}</a></td>
                            <td>{{ $project->assignment->title}}</td>
                            <td>Updated {{ $project->updated_at->diffForHumans() }}</td>
                        </tr> 
                        
                    @endforeach
    
                    </tbody>
                    </table>
                    </div>

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
            