@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       
    <div class="panel col-12">
    <h3 class="text-center m-6"> {{strtoupper($user->firstName)}} {{strtoupper($user->lastName)}}</h3>

            <h4 class="text-center">PORTFOLIO
            </h4>

           <div class="panel-body">

            
            <div class="flex flex-wrap bg-grey-lighter mt-4">
                            
            @foreach ($user->artifacts as $artifact) 

            <div class="flex-col items-center justify-around w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/4 
            bg-white text-grey-darker text-md items-center justify-around">
           
                <a href="{{ action('ArtifactController@show', $artifact->id)}}">
                <img class="block max-w-full m-4 h-auto p-2" src="https://s3.amazonaws.com/artifacts-0.3/{{$artifact->artifact_thumb}}"></a>
            

               <div class="leading-tight p-2 pl-5">

                <i>{{ $artifact->title }}</i><br/>
                {{ $artifact->medium }}<br/>
                {{ $artifact->dimensions_height }} x 
                {{ $artifact->dimensions_width }} 

                @if ($artifact->dimensions_depth)
            
                    x {{ $artifact->dimensions_depth }}
            
                @else
                @endif

                      {{ $artifact->dimensions_units }}
                
                </div>

            </div>

            @endforeach

            </div>        

            </div>

</div>

            

            </div>
        </div>
    </div>
</div>
@endsection

