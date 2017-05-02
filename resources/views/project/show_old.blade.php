OLD PROJECT SHOW

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <!-- Primary Artifacts -->

        <div>

            <div class="media">
                
                <div class="media-body">
                
                    <h4 class="media-heading"><i>{{ $project->title }}</i></h4>
                   
                    Media:<br/>
                    Dimensions:<br/>
                    Submitted {{ $project->created_at->diffForHumans() }}<br/>
                
                </div>

                <div class="media-right">
                    
                    @forelse ($project->artifacts as $artifact) 

<!--                     <img class="media-object" src='{{ url($artifact->artifact_thumb) }}' alt="">
 -->
                    @empty

                        <div class="well"><p>No artifacts currently attached!</p></div>

                    @endforelse
                </div>

            </div>

        </div>

        

        <hr/>

        <div class="col-md-6">

<!--                 <table class='table'>
 -->
                <table border="2">
                <tr>
               
                <td><b>Component</b></td>  
                <td><b>Status</b></td>
                <td><b>File (generic)</b></td>    
                <td><b>File (artifact specific)</b></td>    
                    
 
                </tr>
                
        
        <!-- Interate through components -->

        @foreach ($checklist as $checklist_item)
                
                <tr>
                
                    <!-- Component -->

                    <td> {{$checklist_item->componentTitle}}</td>               

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
                        
                            <a class='' href='{{ action('ProjectController@addArtifact', $project->id) }}'>Upload</a>                    

                        @else 

                             <a href='{{ action('ArtifactController@delete', $artifact->id) }}'>Remove</a>
                             
                             
                                  
                                  <img class='artifact-thumbnail' src='{{ url($checklist_item->artifactThumb) }}'>

                             

                        @endif

                    </td>

                    @if (empty($checklist_item->artifactThumb))
                    <td>

<!-- Begin Form -->

        <form  role="form" method="POST" action="{{ url('/artifact') }}" enctype="multipart/form-data">
        
        {!! csrf_field() !!}

<!-- <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">

 -->    
        <input type="file" class="form-control" name="file" value="{{ old('file') }}"/>

                            <!-- @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif 
</div> -->


       {{ $checklist_item->artifactComponentID }}

        {!! Form::text('component', $checklist_item->artifactComponentID , $checklist_item->artifactComponentID, ['class' => 'form-control']) !!}

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
   
                </td>
                
                @else 
</td>
                @endif

                </tr>



                @endforeach
                </table>

                <ul class="list-inline">
                <li>
                {!! Form::open(['action' => ['ProjectController@edit', $project->id], 'method' => 'Get']) !!}
                {!! Form::submit('Edit') !!}
                {!! Form::close() !!}
                </li>
                <li>
                {!! Form::open(['action' => ['ProjectController@destroy', $project->id], 'method' => 'Delete']) !!}
                {!! Form::submit('Delete') !!}
                {!! Form::close() !!} 
                </li>
                
        
            </ul>

                </div>
                <br/>
            </div>
            </div>
    
    </div>
</div>
                    
@endsection