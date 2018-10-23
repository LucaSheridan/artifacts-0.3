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

              <li><a class='btn btn-default' href="section/create">Add</a>
              </li>
                
    </ul>
    <hr/>
    </div> 
        
    <!-- Here's all the Collection Stuff-->  
     
</div></div> 
