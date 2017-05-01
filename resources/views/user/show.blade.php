@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading"><h3>{{$user->firstName}} {{$user->lastName}}</h3>
            
            @foreach ($user->roles as $role) 
            {{ $role->label}}
            @endforeach    
            |
            @foreach ($user->sites as $site) 
            {{ $site->name}}
            @endforeach    


            </div>
            <div class="panel-body">
            This is where comprehensive information about {{$user->firstName}} {{$user->lastName}} will be included. It will probably take the form of a tabbed table that gives information about student and teacher sections, assignments and exhibitions that are associated with this user.
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

