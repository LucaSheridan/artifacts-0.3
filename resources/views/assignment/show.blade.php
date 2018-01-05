@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
                @if ( Auth::User()->hasRole('teacher'))

                        @include('layouts.partials.assignment.teacher')
                
                    @else

                        @include('layouts.partials.assignment.student')
                    
                    @endif

        </div>
    </div>
</div>
                    
@endsection