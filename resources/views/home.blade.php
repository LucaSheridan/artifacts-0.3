@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="panel panel-default">
               
                @if ( Auth::User()->hasRole('admin'))

                    @include('layouts.partials.admin')
                
                @elseif ( Auth::User()->hasRole('teacher'))

                    @include('layouts.partials.home.teacher')
                
                @else

                    @include('layouts.partials.home.student')
                
            @endif

        </div>
    </div>
    </div>
</div>

@endsection
