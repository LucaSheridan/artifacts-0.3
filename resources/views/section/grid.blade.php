@extends('layouts.app')

@section('content')
<div class="container">

<div class="row">

    <h2>{{ $section->name }} | {{ $assignment->title }}</h2>

    <h4>Assignment Grid View</h4>

</div>

<div class="row">

    @foreach ($students as $student)

    <div class="pull-left project-wrapper">

    <a href='{{ action('SectionController@StudentAssignmentProcessView', ([$section->id, $assignment->id, $student->id ])) }} '> 
    {{$student->firstName}} {{$student->lastName}}
    </a><br/>

        @foreach ($student->artifacts as $artifact)

        <a href="{{ action('ArtifactController@show', $artifact->id)}}">
        <img src ='{{ url($artifact->artifact_thumb) }}'>
        </a>

        <i>{{ $artifact->title }}</i></a><br/>
        {{ $artifact->is_published }}<br/>
        {{ $artifact->medium }}<br/>
        {{ $artifact->dimensions_height }} x 
        {{ $artifact->dimensions_width }} 

            @if ($artifact->dimensions_depth)
    
                x {{ $artifact->dimensions_depth }}
            
             @else
            @endif
            
        {{ $artifact->dimensions_units }}<br/>
        
            <br/>
            </a>

        </div></div>

    @endforeach

</div>



@endforeach



</div>
        




</div>
</div>
                    
@endsection

