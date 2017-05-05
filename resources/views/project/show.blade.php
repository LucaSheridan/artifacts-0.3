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

                        <img class='artifact-thumbnail' src='{{ url($checklist_item->artifactThumb) }}'>
                    
                    @else

                        

                    @endif

                    </td>
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
                        
                        <!-- Begin Form -->

                        <form  role="form" method="POST" action="{{ url('/artifact') }}" enctype="multipart/form-data">
                        
                        {!! csrf_field() !!}

                        <!-- <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">

                         -->    
                        
                        <span class="btn btn-default btn-file">Browse 
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

                             <a href='{{ action('ArtifactController@delete', $checklist_item->artifactID) }}'>Remove</a>
                             
                        @endif

                    </td>

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