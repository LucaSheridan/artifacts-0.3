@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading">
       
            <h3>
            Progress Report:
            <a href="{{ action('UserController@show', $user->id)}}">{{$user->firstName}} {{$user->lastName}}</a>
            </h3>

        </div>

<!--         {{ $checklist }}
 -->
        <!-- Begin Table Div -->

        <div class="panel-body">
        
        {{-- Begin Table --}}

        <table class="table table-bordered">

            @foreach ($checklist as $checklist_item)

        {{-- Look for unset/not matching current assignent variable --}}

                @if (empty($current_assignment) or ($current_assignment != $checklist_item->assignment_id))

        {{-- Assignment Header--}}

                    <tr>
                        <td colspan="4">
                            <h4>
                                {{ $checklist_item->assignment->title }}</a>
                            </h4>
                        </td>
                    </tr>

        {{-- Table Columns --}}

                    <tr>
                        <th scope="col">Artifact</th>                        
                        <th scope="col">Component</th>                        
                        <th scope="col">Due Date</th>
                        <th scope="col">Status</th>
                    </tr>

        {{-- First Component of an Assignment --}}

                    <tr>
                        
                        {{-- Artifact--}}

                        <td>

                            @if ($checklist_item->artifact_thumb)
                            <a href="{{ action('ArtifactController@show', $checklist_item->artifact_id)}}">
                            <img class="artifact-thumbnail" src="https://s3.amazonaws.com/artifacts-0.3/{{$checklist_item->artifact_path}}"></a>
                            @else
                            pending
                            @endif

                        </td>

                        {{-- Component Title--}}            
            
                        <td>
                            
                            {{-- Link Presentation Logic --}}

                            @if ($checklist_item->artifact_thumb)
                            <a href="{{ action('ArtifactController@show', $checklist_item->artifact_id)}}">
                            {{ $checklist_item->component_title }}</a>
                            @else
                            {{ $checklist_item->component_title }}
                            @endif

                        </td>

                        {{-- Due Date --}}

                        <td>
                            {{ Carbon\Carbon::parse($checklist_item->component_due)->format('n/j ') }}
                        </td>
                       
                        {{-- Status--}}   
                        
                        <td>
                                    {{-- Status Presentation Logic --}}

                                    @if (!$checklist_item->artifact_thumb)

                                        <span class="label label-default">Pending</span>
            
                                    @else

                                     @php
                                     $duedate = Carbon\Carbon::parse($checklist_item->component_due)->setTimezone('America/New_York') 
                                     @endphp

                                    @if ($checklist_item->artifact_created <= $duedate)

                                         <span class="label label-success">
                                         Uploaded {{ Carbon\Carbon::parse($checklist_item->artifact_created)->setTimezone('America/New_York')->format('n/j') }}</span>
                                    
                                    @else 

                                         <span class="label label-warning">
                                         Uploaded {{ Carbon\Carbon::parse($checklist_item->artifact_created)
                                         ->setTimezone('America/New_York')
                                         ->format('n/j') }}</span>

                                    @endif

                                    {{-- End Status Presentation Logic --}}

                @endif
                                
                        </td>

                    @php
                        $current_assignment = $checklist_item->assignment_id;
                    @endphp
                   
                @else

            {{-- Other Components of an Assignment --}}

                     <tr>

            {{-- Artifact--}}

                        <td>

                            @if ($checklist_item->artifact_thumb)
                            <a href="{{ action('ArtifactController@show', $checklist_item->artifact_id)}}">
                            <img class="artifact-thumbnail" src="https://s3.amazonaws.com/artifacts-0.3/{{$checklist_item->artifact_path}}"></a>
                            @else
                            pending
                            @endif

                        </td>
           
              {{-- Component Title--}}            
            
                        <td>
                            
                            {{-- Link Presentation Logic --}}

                            @if ($checklist_item->artifact_thumb)
                            <a href="{{ action('ArtifactController@show', $checklist_item->artifact_id)}}">
                            {{ $checklist_item->component_title }}</a>
                            @else
                            {{ $checklist_item->component_title }}
                            @endif

                        </td>

            {{-- Due Date --}}

                        <td>
                            {{ Carbon\Carbon::parse($checklist_item->component_due)->format('n/j ') }}
                        </td>
            
            {{-- Status--}}   
            
                        <td>
                                    {{-- Status Presentation Logic --}}

                                    @if (!$checklist_item->artifact_thumb)

                                        <span class="label label-default">Pending</span>
            
                                    @else

                                     @php
                                     $duedate = Carbon\Carbon::parse($checklist_item->component_due) 
                                     @endphp

                                    @if ($checklist_item->artifact_created <= $duedate)

                                         <span class="label label-success">
                                         Uploaded {{ Carbon\Carbon::parse($checklist_item->artifact_created)->setTimezone('America/New_York')->format('n/j') }}</span>
                                    
                                    @else 

                                         <span class="label label-warning">
                                         Uploaded {{ Carbon\Carbon::parse($checklist_item->artifact_created)
                                         ->setTimezone('America/New_York')
                                         ->format('n/j') }}</span>

                                    @endif

                                    {{-- End Status Presentation Logic --}}



                @endif

                                
                        </td>

                    </tr>

                @endif
                
            @endforeach

        </table>
            
            

        
      
        </div>

        

         </div>
    </div>
                    
@endsection
