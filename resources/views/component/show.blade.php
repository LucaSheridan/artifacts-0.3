@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        Title: {{ $component->title }}<br/>
        Description: {{ $component->title }}<br/>
        Due Date: {{ $artifact->date_due }}<br/>

      	<a href='{{ action('ComponentController@delete', $component->id) }}'>Delete</a><br/>

    </div>
</div>
                    
@endsection