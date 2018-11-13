<h1><a href="{{ action('HomeController@index')}}">{{$assignment->section->name }}</a> | {{ $assignment->title}}</h1><br/>

<!-- Feedback -->

        @if ( count($assignment->comments) > 0 )

    <div class="container">
        <div class="alert-important alert alert-warning}}" style="background:lightyellow;">
        
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>You have Feedback!</b><br/>
         @foreach ($assignment->comments as $comment)
        
        <span style="text-decoration:underline; padding-bottom:0.25em;">{{$comment->artifact->component->title}}:</span> <i>{{$comment->body}}</i><br/>
    @endforeach

        </div>
    </div>

    @else
    @endif

    <table class="table">

     <tr>
                <td><b>Image</b></td>  
                <td><b>Component</b></td>
                <td><b>Due Date</b></td>
                <td><b>Status</b></td>
                <td></td>
    </tr> 

    @foreach ($checklist as $checklistItem)
    
    <tr>
    
    <!-- Component Thumbnail -->

    <td>

            @if (!$checklistItem->artifactID)

                    <div>
                    
                    No Artifact

                    </div>

                    @else

                    <a href="{{ action('ArtifactController@show', $checklistItem->artifactID)}}">

                    <img class="artifact-thumbnail" src="https://s3.amazonaws.com/artifacts-0.3/{{$checklistItem->artifactThumb}}"></a><br>


                 @endif
   
    </td>
    
    <!-- Component Title -->

    <td>{{ $checklistItem->componentTitle }}</td>
    
    <!-- Due Date -->

    <td>
    
    {{ Carbon\Carbon::parse($checklistItem->componentDateDue)->format('n/j/Y ') }}
    <!-- {{ Carbon\Carbon::parse($checklistItem->componentDateDue)->format('D n/j g:i a') }}-->
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
                                 Submitted {{ Carbon\Carbon::parse($checklistItem->artifactCreatedAt)->setTimezone('America/New_York')->format('n/j') }}</span>
                            @else 

                                 <span class="label label-warning">
                                 Submitted {{ Carbon\Carbon::parse($checklistItem->artifactCreatedAt)
                                 ->setTimezone('America/New_York')
                                 ->format('n/j') }}</span>

                            @endif

                @endif

    </td>

    <!-- Published Status -->

 <!--    <td>

                @if ($checklistItem->is_published)

                <span class="label label-success">

                @else

                @endif

                
    </td> -->
    
    <!-- Browse/Upload/Edit/Delete -->

    <td>

    @if ($checklistItem->artifactID)

     <a class="btn btn-default" href='{{ action('ArtifactController@show', $checklistItem->artifactID) }}'>View</a>
    
     <a class="btn btn-success" href='{{ action('ArtifactController@create', $checklistItem->componentID) }}'>Add</a>

    <a class="btn btn-danger" href='{{ action('ArtifactController@delete', $checklistItem->artifactID) }}'>Delete</a>
    
    @else

     <form  role="form" method="POST" action="{{ url('/artifact') }}" enctype="multipart/form-data">
                        
        {!! csrf_field() !!}

        <span class="btn btn-default btn-file">Select File
        <input type="file" class="btn btn-default" name="file" value="{{ old('file') }}"/></span>

        {!! Form::hidden('component', $checklistItem->componentID ) !!}
                   
        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
        <input type="hidden" name="assignment_id" value="{{$checklistItem->assignmentID}}">
        <input type="hidden" name="component_id" value="{{$checklistItem->componentID}}">
        
       <button id="upload" type="submit" class="btn btn-success">Upload
       </button>

        <!-- File Uplaod Errors-->

        @if ($errors->has('file'))
        
            <span class="help-block">
            <strong>{{ $errors->first('file') }}</strong>
            </span>
        
        @endif
                                        
        </form>

    @endif

    </td>


</tr>

@endforeach

</table>




