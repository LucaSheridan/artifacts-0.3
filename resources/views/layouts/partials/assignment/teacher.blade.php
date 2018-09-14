<div class="container">
    <div class="row">
        <div class="col-md-12">
            
                    <div class="row">
                        
                        <div class="col-md-12">

                            <div class="col-md-6">

                                
                            <!-- HEADING -->
                            
                            <h3>Assignment Summary</h3><br/>
                            
                            <!-- BEGIN PANEL -->
                            
                             <div class="panel panel-default">

                            
                            <div class="panel-heading">

                            <b>Project Title:</b> {{ $assignment->title}}
                             <span class="pull-right"> <a href='{{action('AssignmentController@edit', $assignment->id)}}'>Edit</a></span>

                            </div>
<div class="panel-body"><p><b>Description:</b> {{ $assignment->description}}</p>


</div></div></div>

                            <div class="col-md-6">

                            <h3>Assignment Components</h3><br/>
                        
                                        
 <!-- BEGIN PANEL -->
 <div class="panel panel-default">
    
    <!-- HEADING -->
    <div class="panel-heading">
    
    Components 

    <a class='pull-right' href='{{action('ComponentController@create', $assignment->id)}}'>Add a Component</a>

    </div>

    <div class="body">

    <!-- Begin Components Table -->

<table class="table">

    @foreach ($assignment->components as $component)
  
    <tr>
    
    <!-- Component Title -->

    <td><a href='{{action('SectionController@AssignmentComponent', ['section' => $assignment->section->id, 'assignment' => $component->assignment_id, 'component' => $component->id])}}'>{{ $component->title }}</a></td>
    
    <!-- Due Date -->

    <td>
    
    Due {{ Carbon\Carbon::parse($component->date_due)->setTimezone('America/New_York')->format('D n/j') }}

   
    </td>


    <td>
                <a href='{{action('ComponentController@edit', $component->id)}}'>Edit</a> | 
                <a href='{{action('ComponentController@delete', $component->id)}}'>Delete</a>
    
    </tr>    <!-- Add Component Button -->


    @endforeach
    </table>
    
    </div>

      <!-- End Panel -->


                                  
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
                                    
                                
                        

                                </div>
                            </div>


                            </div>
          
                        </div>
                    </div>
                </div>
            </div>         
        </div>
    </div>
</div>


</div>

    </div>


