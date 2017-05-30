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
                <h2>{{ $assignment->title }}</h2>

                <table class="table-header-rotated">
                <thead>
                
                

                  @foreach ($checklist as $checklist_item)

                   <th class="rotate"><div><span>
                
                   {{$checklist_item->componentTitle}}

                   </span></div></th>

                @endforeach

                </tr>
                </thead>

                <tr>

                @foreach ($checklist as $checklist_item)

                   <td class="grid">
                
                       @if ($checklist_item->artifactThumb) 

                       <a href="{{ url($checklist_item->artifactPath) }}"><img class="artifact-thumbnail" src="{{ url($checklist_item->artifactThumb) }}">
                        
<!--                        <span class="glyphicon glyphicon-ok green" aria-hidden="true"></span>
 -->
                       @else

                       <span class="glyphicon glyphicon-minus yellow" aria-hidden="true"></span> 

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