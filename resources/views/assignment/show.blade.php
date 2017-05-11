@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-6">

                <b>{{ $assignment->title }}</b><br/>
                
                <p>{{ $assignment->description }}</p>

                <p>{{ $assignment->date_due }}</p>
       
                <ul>
                    @foreach ($assignment->components as $component)
                    <li>{{ $component->title }} | {{ Carbon\Carbon::parse($component->date_due)->format('D n/j') }}</li>
                    @endforeach 
                </ul>

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