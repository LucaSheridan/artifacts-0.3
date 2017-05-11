@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">Component Index</div>
            <div class="panel-body">
            <table class='table'>
            <thead>
            <tr>
            <td>
            Title
            </td>
            <td>
            Assignment ID
            </td>
            </tr>
            </thead>
            
            @foreach ($components as $component)
            <tr>
            <td>
            {{ $component->title}}<a>
            </td>
            <td>
            {{ $component->assignment_id }}
            </td>
            <td>
            {{ $component->id }}
            </td>
            
            @endforeach            
            
            </table>

            </div>
            
            
            </div>
        </div>
    </div>
</div>
@endsection

