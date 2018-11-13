@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-12">

        <div class="panel panel-default">
        <div class="panel-heading">
    
        <h2>
            <a href="{{ action('UserController@show', $user->id)}}">
        {{$user->firstName}} {{$user->lastName}}</a>
        </h2>


        <h4><a href="{{ action('SectionController@show', $section->id)}}">
            {{$section->name}}</a> | Assignment Detail View</h4>

        </div>
        </div>
        </div>
        </div>

        <div class="row">
        
        <div class="col-md-3">
        <div class="panel panel-default">
            
            <div class="panel-heading">
            Assignments
            </div> 
            
            <div class="panel-body">

            @foreach ($section->assignments as $sectionAssignment)

            <a href="{{ action('SectionController@StudentAssignmentProgressView', ['section' => $section->id, 'assignment' => $sectionAssignment->id, 'user' => $user->id ]) }}">
            {{ $sectionAssignment->title }}</a>
            <br/>

            @endforeach

            </div>
        
        </div>
        </div>

        <div class="col-md-9">
        <div class="panel panel-default">
            
        <div class="panel-heading">
           
           <b>{{$assignment->title}}</b>
           
           <span class='pull-right'>

                <a href="{{ action('SectionController@StudentAssignmentProgressView', ['$section' => $section->id, '$assignment' => $assignment->id, '$student' => $user->id])}}">Progress View</a> |
                Detail View
           </span>
        
            </div> 

            <div class="panel-body">

        <!-- Feedback -->

        @if ( count($assignment->comments) > 0 )

        <div class="alert-important alert alert-warning}}" style="background:lightyellow;">
        
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>You have Feedback!</b><br/>
         @foreach ($assignment->comments as $comment)
        
        <span style="text-decoration:underline; padding-bottom:0.25em;">{{$comment->artifact->component->title}}:</span> <i>{{$comment->body}}</i><br/>
    @endforeach

    </div>

    @else
    @endif

    <!-- End Feedback -->

        <table class="table">

        @foreach ($assignmentChecklist as $checklistItem)
    
        <tr>
    
        <!-- Component Thumbnail -->

        <td><b>{{ $checklistItem->componentTitle }}</b> | Due: {{ Carbon\Carbon::parse($checklistItem->componentDateDue)->format('n/j/Y g:i a') }}<br/><br/>
    
        @if (!$checklistItem->artifactID)

                    <div>
                    No image uploaded.<br/>
                    </div>

                    @else

                    <a href="{{ action('ArtifactController@show', $checklistItem->artifactID)}}">
                    <img class="img-responsive" src="https://s3.amazonaws.com/artifacts-0.3/{{$checklistItem->artifactPath}}">

                    </a>

            @endif
   
    </td>
    
    
    
    <td>
     @if ($checklistItem->is_published)
    <span class="label label-success">
    <span class="glyphicon glyphicon-ok"></span> Published</span>
    @else
    @endif
    
    </td>

    </tr>
    @endforeach
    </table>

            

            </div>
        
        </div>
        </div>

        

         </div>
    </div>
</div>
    </div>
</div>
                    
@endsection
