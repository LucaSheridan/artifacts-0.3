@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
               
            <div class="panel-heading">User Index</div>
            <div class="panel-body">
            
            <table class='table'>
                
                <thead>
                <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Site</td>
                <td>Sections</td>
                <td>Edit</td>
                <td>Delete</td>
                </tr>
                </thead>
                
            @foreach ($users as $user)
            
            <tr>
           
                <td><a href='{{ action('UserController@show', $user->id) }}'>{{ $user->firstName}} {{ $user->lastName}}</a>
               </td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role) 
                    {{ $role->label}}<br/>
                    @endforeach    
                </td>
               <td>
                    @foreach ($user->sites as $site) 
                    {{ $site->name }}<br/>
                    @endforeach
                
                </td>
                <td>
                    @foreach ($user->sections as $section) 
                    {{ $section->label }}<br/>
                    @endforeach
                
                </td>
                <td><a href='{{ action('UserController@edit', $user->id) }}'>Edit<a></td>
                </td>
                <td><a href='{{ action('UserController@delete', $user->id) }}'>Delete<a></td>
            </tr>
            
            @endforeach
            
            </table>

            </div>
            
            
            </div>
        </div>
    </div>
</div>
@endsection

