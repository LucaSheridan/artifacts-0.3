<div class="panel-heading">Teacher Dashboard</div>

<div class="panel-body">
                
                <ul>

                    @foreach ( Auth::User()->sections as $section) 
                    
                    <li>
                        <a href='{{ action('SectionController@show', $section->id) }}'>{{ $section->label}}</a>
                    </li>
                                                         
                    @endforeach
                
                </ul>
                
                <a class='btn btn-primary' href="section/create">Create a Section</a>
                                
</div>