<div class="container">

<!-- Begin Assignment Description -->

<div class="col-lg-12 panel">

<h1><a href='{{action('SectionController@show', $assignment->section->id )}}'>{{ $assignment->section->name}}</a> | {{ $assignment->title}}</h1>
<hr>

<p><b>Descripton:</b><br/>
{{ $assignment->description}}</p>
<!-- Edit and Delete Buttons -->

    <a class='btn btn-primary' href='{{action('AssignmentController@edit', $assignment->id)}}'>Edit Assignment</a>
    <br/><br/>

</div>

<!-- Begin Components Table -->

<div class="col-lg-12 panel">


<p><b>Components:</b></p>

<table class="table">

     <tr>
   
    <td><b>Title</b></td>
    <td><b>Due Date</b></td>
    <td>
   </td>


    </td>    

    </tr> 

    @foreach ($assignment->components as $component)
  
    <tr>
    
    <!-- Component Title -->

    <td>{{ $component->title }}</td>
    
    <!-- Due Date -->

    <td>
    
    {{ Carbon\Carbon::parse($component->date_due)->setTimezone('America/New_York')->format('D n/j') }}

   
    </td>

    <td>
    	<a class='btn btn-primary' href='{{action('ComponentController@edit', $component->id)}}'>edit</a>
		<a class='btn btn-danger' href='{{action('ComponentController@delete', $component->id)}}'>delete</a>

    </td>

    </tr>
    @endforeach
    </table>


    <!-- Add Component Button -->

    <a class='btn btn-primary' href='{{action('ComponentController@create', $assignment->id)}}'>Add a Component</a>


    <br/><br/>

    </div>

    </div>


