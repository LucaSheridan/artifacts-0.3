@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div>
            <div class="media">
                <div class="media-left">

                @if ($project->primaryArtifactThumb)

                <img class="media-object" src="{{ url($project->primaryArtifactThumb) }}">

                @else 

                    <div class="project-placeholder">
                    <p>In Progress</p>
                    </div>
                @endif
                    
                </div>

                <div class="media-body">
                
                    <b>Title:</b> <i>{{ $project->title }}</i><br/>
                    <b>Medium:</b> {{ $project->medium }}<br/>
                    <b>Dimensions:</b> {{ $project->dimensions }}<br/>
                    <b>Completed:</b> {{ $project->created_at->diffForHumans() }}<br/>
                    <b>Submitted for:</b> {{ $project->assignment->title }}<br/>

                <br/><br/>

                <ul class="list-inline">
                <li>
                
                <div class="submit-button-container">
               
                {!! Form::open(['action' => ['ProjectController@edit', $project->id], 
                                'method' => 'Get',
                                'class' => 'btn btn-primary']) !!}
                {!! Form::submit('Edit Project Information') !!}
                {!! Form::close() !!}
                
                </div>
                </li>

                <li>
                <div class="submit-button-container">

                {!! Form::open(['action' => ['ProjectController@delete', $project->id], 
                                'method' => 'Get',
                                'class' => 'btn btn-danger']) !!}
                {!! Form::submit('Delete Project') !!}
                {!! Form::close() !!} 
                
                </div>
                </li>
                </ul>
                


        </div>
                
               <br/>

                
            </div>
        </div>

        <!-- Begin components header -->

        <table class='table'>

                <tr>
                <td><b>Image</b></td>  
                <td><b>Component</b></td>  
                <td><b>Status</b></td>
                <td><b>Action</b></td>    
                </tr>       
        
        <!-- Interate through components -->

        @foreach ($checklist as $checklist_item)

                <tr>
                    <td>
                   
                    
                    @if ($checklist_item->artifactThumb)

                    <a href='{{ action('ArtifactController@show', $checklist_item->artifactID) }}'>
                        <img class='artifact-thumbnail' src='{{ url($checklist_item->artifactThumb) }}'>
                    </a>
                    
                    @else

                        <img class='artifact-thumbnail'>

                    @endif

                    </td>
                    
                    <!-- Component -->

                    <td> 

                    @if ($checklist_item->componentTitle) 

                        {{ $checklist_item->componentTitle }}

                    @else
                    @endif

                    </td> 

                    <!-- Status-->

                    <td> 
                    
                        @if (empty($checklist_item->artifactComponentID))Due 

                            {{ Carbon\Carbon::parse($checklist_item->date_due)->format('D n/j') }}
                   
                        @else 

                            Submitted {{Carbon\Carbon::parse($checklist_item->created_at)->format('D n/j')}}

                        @endif

                    </td>
                    
                   
                    <!-- Upload/Remove -->

                    <td> 
                        
                        @if (empty($checklist_item->artifactThumb))
                        
                        <!-- Begin Form -->

                        <form  role="form" method="POST" action="{{ url('/artifact') }}" enctype="multipart/form-data">
                        
                        {!! csrf_field() !!}

                        <!-- <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">

                         -->    
                        
                        <span class="btn btn-default btn-file">Select Image 
                        <input type="file" class="form-control" name="file" value="{{ old('file') }}"/>
                        </span>


                                                    <!-- @if ($errors->has('file'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('file') }}</strong>
                                                            </span>
                                                        @endif 
                                </div> -->


                                {!! Form::hidden('component', $checklist_item->componentID) !!}

                                                    @if ($errors->has('component'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('component') }}</strong>
                                                            </span>
                                                    @endif
                                                    

                                    <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <input type="hidden" name="assignment_id" value="{{ $project->assignment_id }}">

                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                        
                                
                        </form>

<!-- End Form -->        
                    
                        @else 

                             <a href='{{ action('ArtifactController@delete', $checklist_item->artifactID) }}'>Remove</a> |
                             <a href='{{ action('ArtifactController@rotate', $checklist_item->artifactID) }}'>Rotate</a>
                             
                        @endif

                    </td>

                </tr>

                @endforeach
                
</table>
                    
            </div>
            </div>
    
    </div>
</div>
                    
@endsection