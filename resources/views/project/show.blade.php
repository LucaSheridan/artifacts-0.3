@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <!-- Primary Artifacts -->

        <div>

        
        <div class="media">

        

            <div class="media-body">
            
                <h4 class="media-heading"><i>{{ $project->title }}</i></h4>
               
                {{ $project->user->firstName }} {{ $project->user->lastName }}<br/>
                Media:<br/>
                Dimensions:<br/>
                Submitted {{ $project->created_at->diffForHumans() }}<br/>
            
            </div>

             <div class="media-left">
                
                @forelse ($project->artifacts as $artifact) 

                <img class="media-object" src='{{ url($artifact->artifact_thumb) }}' alt="">

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
               
                <td><b>Component</b></td>  
                <td><b>Status</b></td>
                <td><b>File</b></td>    
                    
 
                </tr>
                @foreach ($checklist as $checklist_item)
                <tr>
                
                    <td> {{$checklist_item->componentTitle}}</td>               

                    <td> 
                    
                    @if (empty($checklist_item->artifactComponentID))Due 

                        {{ Carbon\Carbon::parse($checklist_item->date_due)->format('D n/j') }}<br/>
                   
                    @else Submitted {{Carbon\Carbon::parse($checklist_item->created_at)->format('D n/j')}}</td>
                
                    @endif

                <td> 
                @if (empty($checklist_item->artifactThumb))
                <a class='' href='{{ action('ProjectController@addArtifact', $project->id) }}'>Upload</a>
                </td>
                
                @else 

                <a href='{{ url($checklist_item->artifactPath) }}'>Link</a> | <a href='#'>Remove</a></td>
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