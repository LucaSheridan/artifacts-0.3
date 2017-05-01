@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               
        
            @if ( Auth::User()->hasRole('admin'))

                @include('layouts.partials.admin')
            
            @elseif ( Auth::User()->hasRole('teacher'))

                @include('layouts.partials.teacher')
            
            @else

                @include('layouts.partials.student')
            
            @endif
            </div>
        </div>
    </div>
</div>

@endsection
