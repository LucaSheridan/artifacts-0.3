@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
               
            <div class="panel-heading">Artifacts Index</div>
            <div class="panel-body">
                
            @foreach ($artifacts as $artifact)
                        <div class="pull-left"> <img class='thumbnail' src="{{ url($artifact->artifact_thumb) }}"></div>
            @endforeach
            
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

