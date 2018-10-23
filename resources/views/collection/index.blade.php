@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">Collection Index</div>
            <div class="panel-body">
            <table class='table'>
            <thead>
            <tr>
            <td>
            Curator
            </td>
            <td>
            Title
            </td>
            </tr>
            </thead>
            
            @foreach ($collections as $collection)
            <tr>
            
            <td>
            @foreach ($collection->curators as $curator) 
            
            @endforeach 
            </td>
            
            <td>
            <a href="{{action('CollectionController@show', $collection->id)}}">{{ $collection->title}}</a>
            </td>
            <td>
            
                @foreach ($collection->artifacts as $artifact)

                    <div class="pull-left">
                        <img class="artifact-thumbnail float-left" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}"></a>
                    </div>

                @endforeach

            </td>
            
            
            @endforeach            
            
            </table>

            </div>
            
            
            </div>

        </div>
    </div>
</div>
@endsection

