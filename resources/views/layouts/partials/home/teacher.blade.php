          

                    <div class="panel-heading">Teacher Dashboard</div>

<div class="panel-body">

<h4>Classes</h4><br/>
                
                
                   <ul class="list-inline">

                    @foreach ( Auth::User()->sections as $section) 
                    
                    <li>
                        
                        <a class="btn btn-default" href='{{ action('SectionController@show', $section->id) }}'>{{ $section->label}}</a>
                    
                
                    </li>

                    @endforeach
                
                    <li>
                    <a class='btn btn-primary' href="section/create">Add</a>
                    </li>
                                                         
                
                </ul>
                
                
                                
</div>