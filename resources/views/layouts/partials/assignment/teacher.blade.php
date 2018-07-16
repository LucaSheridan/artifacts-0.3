<div class="container">

<!-- Begin Assignment Description -->

<div class="panel panel-default">
               
<div class="panel-heading">
<a href='{{action('SectionController@show', $assignment->section->id )}}'>{{ $assignment->section->label}}</a> | 
{{ $assignment->title}}
<span class="pull-right"> <a href='{{action('AssignmentController@edit', $assignment->id)}}'>Edit</a></span>
</div>

<div class="col-lg-12 panel">

<br><p><b>Project Description:</b> {{ $assignment->description}}</p>

<br><p><b>Project Timetable:</b>

<br/>


<!-- Begin Components Table -->

<table class="table">

     <tr>
   
    <td><b>Component</b></td>
    <td><b>Due Date</b></td>
    <td>
   </td>


    </td>    

    </tr> 

    @foreach ($assignment->components as $component)
  
    <tr>
    
    <!-- Component Title -->

    <td><a href='{{action('SectionController@AssignmentComponent', ['section' => $assignment->section->id, 'assignment' => $component->assignment_id, 'component' => $component->id])}}'>{{ $component->title }}</a></td>
    
    <!-- Due Date -->

    <td>
    
    {{ Carbon\Carbon::parse($component->date_due)->setTimezone('America/New_York')->format('D n/j') }}

   
    </td>

    <td>
    	<div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>

            <ul class="dropdown-menu">
                <li><a href='{{action('ComponentController@edit', $component->id)}}'>edit</a></li>
		        <li><a href='{{action('ComponentController@delete', $component->id)}}'>delete</a></li>
            </ul>
        </div>
    </td>

    </tr>    <!-- Add Component Button -->


    @endforeach
    </table>
        <a class='btn btn-primary' href='{{action('ComponentController@create', $assignment->id)}}'>Add a Component</a>

    </div>

    <br/><br/>

    </div>

    </div>


