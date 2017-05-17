@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
                <div class="col-md-2">

                @foreach ($students as $student)
                <a href="?id={{ $student->id}}">{{ $student->firstName}} {{ $student->lastName}}</a><br>
                @endforeach

                </div>

                <div class="col-md-6">

                <table border="1">
                
                <tr>

                  @foreach ($checklist as $checklist_item)

                   <td>
                
                   {{$checklist_item->componentTitle}}

                   </td>

                @endforeach

                </tr>
                <tr>

                @foreach ($checklist as $checklist_item)

                   <td>
                
                       @if ($checklist_item->artifactThumb) 

                       <img class="thumbnail" src="{{ url($checklist_item->artifactThumb) }}">

                        @else
                        @endif

                    </td>

                @endforeach

                </tr>
                </table>
                </br>
                <a class='btn btn-primary' href='{{action('AssignmentController@edit', $assignment->id)}}'>edit</a>

                <a class='btn btn-danger' href='{{action('AssignmentController@delete', $assignment->id)}}'>delete</a>

                
        
            </ul>


                </div>
                <br/>
            </div>

                </p>


        </div>
    </div>
</div>
                    
@endsection