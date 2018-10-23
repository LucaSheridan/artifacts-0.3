<div class="container ">
<div class="row well">

    
        <!-- Begin Classes -->

<div class="col-md-12">
                                                
<h4>CLASSES</h4>

    <ul class="list-inline">

        @foreach ( Auth::User()->sections as $section) 
            
            @if ( $section->active )

              <li>
              <a class="btn btn-default" href='{{ action('SectionController@show', $section->id) }}'>{{ $section->label}}</a>
              </li>
  
            @else
            @endif
                   
        @endforeach

              <li><a class='btn btn-default' href="section/create">New</a>
              </li>
                
    </ul>
    <hr/>
    </div> 
        
        <!-- Begin Collections -->

<!--         <div class="col-md-12">

        <h4>COLLECTIONS</h4>
        <p>Organize and present your work by creating collections of artifacts.</p>   

         <div class="" style="display: flex">

         @foreach (Auth::User()->collections as $collection)

                <div class="" style="padding:6px;">

                <a href="{{ action('CollectionController@show', $collection->id )}}">

                @if ($collection->cover_thumb)

                    <img  class="img-responsive" src="https://s3.amazonaws.com/artifacts-0.3/{{ $collection->cover_thumb}}">
            
            @else
                    
            <div style="height:200px; width:200px; background-color:#CFCFCF; ">
            <p class="text-center">No artifacts have been added to this portfolio.</p>
            </div>

            @endif

            <H4 class="text-left">{{ $collection->title }}
            </a>

            <span style="font-size:80%; color: #CCC; margin-right:4px; padding: 2px;" class="pull-right">{{ count($collection->artifacts)}}</span></H4>
    </div>

@endforeach
</div></div> -->
