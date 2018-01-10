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
            {{$section->name}}</a> | Assignment Progress View</h4>

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
           <span class='pull-right'>Progress View | <a href="{{ action('SectionController@StudentAssignmentDetailView', ['$section' => $section->id, '$assignment' => $assignment->id, '$student' => $user->id])}}">Detail View</a></span>
            </div> 
            
            <div class="panel-body">

        <table class="table">

        <tr>
                <td><b>Image</b></td>  
                <td><b>Component</b></td>
                <td><b>Due Date</b></td>
                <td><b>Status</b></td>    
                <td><b>Published</b></td>    
                <td></td>    
        </tr> 

        @foreach ($assignmentChecklist as $checklistItem)
    
        <tr>
    
        <!-- Component Thumbnail -->

        <td>

            @if (!$checklistItem->artifactID)

                    <div>
                    no artifact
                    </div>

                    @else

                    <a href="{{ action('ArtifactController@show', $checklistItem->artifactID)}}">
                    <img class="artifact-thumbnail" src="https://s3.amazonaws.com/artifacts-0.3/{{$checklistItem->artifactThumb}}">

                    </a>

            @endif
   
    </td>
    
    <!-- Component Title -->

    <td>{{ $checklistItem->componentTitle }}</td>
    
    <!-- Due Date -->

    <td>
    {{ Carbon\Carbon::parse($checklistItem->componentDateDue)->format('n/j/Y g:i a') }}

    <!--     {{ Carbon\Carbon::parse($checklistItem->componentDateDue)->format('n/j/y g:i a') }}-->
    </td>
   
    <!-- Submission Status -->

    <td>
             @if (!$checklistItem->artifactID)

                        <span class="label label-default">Pending</span>
            
                        @else

                            @php
    
                            $duedate = Carbon\Carbon::parse($checklistItem->componentDateDue) 
                            
                            @endphp

                            @if ($checklistItem->artifactCreatedAt <= $duedate)

                                 <span class="label label-success">
                                 Uploaded {{ Carbon\Carbon::parse($checklistItem->artifactCreatedAt)->setTimezone('America/New_York')->format('n/j') }}</span>
                            @else 

                                 <span class="label label-warning">
                                 Uploaded {{ Carbon\Carbon::parse($checklistItem->artifactCreatedAt)
                                 ->setTimezone('America/New_York')
                                 ->format('n/j') }}</span>

                            @endif

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
