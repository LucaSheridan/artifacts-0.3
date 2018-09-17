          

                    <div class="panel-heading">Teacher Dashboard</div>

<div class="panel-body">

<h4>Classes</h4><br/>
                
                
                   <ul class="list-inline">

                    @foreach ( Auth::User()->sections as $section) 
                    
                        
                       @if ( $section->active )

                    <li>
                        <a class="btn btn-default" href='{{ action('SectionController@show', $section->id) }}'>{{ $section->label}}</a>                    
                    </li>

                    @else
                   <!--  
                    <li>
                        <a class="btn btn-disabled" href='{{ action('SectionController@show', $section->id) }}'>{{ $section->label}}</a>                    
                    </li>     -->                
                    @endif
                   

                    @endforeach
                
                    <li>
                    <a class='btn btn-primary' href="section/create">Add</a>
                    </li>
                                                         
                
                </ul>
                
                
                                
</div>