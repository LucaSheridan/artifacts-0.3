@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">Section Index</div>
            <div class="panel-body">
            <table class='table'>
            <thead>
            <tr>
            <td>
            Name
            </td>
            <td>
            Label
            </td>
             <td>
            Code
            </td>
            <td>
            Site
            </td>
            <td>Teacher
            </td>
            <td>Delete
            </td>
            <td>Edit
            </td>
            </tr>
            </thead>
            
            @foreach ($sections as $section)
            <tr>
            <td>
            <a href='{{ action('SectionController@show', $section->id) }}'>{{ $section->name}}<a>
            </td>
            <td>
            {{ $section->label }}
            </td>
            <td>
            {{ $section->code }}
            </td>
            <td>
            {{ $section->site->name }}
            </td>
            <td>
            
            @foreach ($section->users as $user)
            
            @unless ( $user->hasRole('student') )
            {{ $user->firstName }} {{ $user->lastName }}
            @endunless

            @endforeach            
            
            </td>
             <td>
             <a href='{{ action('SectionController@delete', $section->id) }}'>Delete<a>
             </td>
            </td>
                <td><a href='{{ action('SectionController@edit', $section->id) }}'>Edit<a></td>
            </tr>
            
            @endforeach
            </table>

            <a href='{{ action('SectionController@create') }}' class='btn btn-primary'>Create a New Section</a>

            </div>
            
            
            </div>

        </div>
    </div>
</div>
@endsection

