<div class="container">

<!-- Begin Assignment Description -->

<div class="col-lg-6">

<h1>{{ $assignment->title}}</h1>
<p><b>Descripton:</b><br/>
{{ $assignment->description}}</p>

<hr>

<!-- Edit and Delete Buttons -->

    <a class='btn btn-primary' href='{{action('AssignmentController@edit', $assignment->id)}}'>Edit Assignment</a>
    <a class='btn btn-danger' href='{{action('AssignmentController@delete', $assignment->id)}}'>Delete Assignment</a>
    <br/><br/>

</div>

<!-- Begin Components Table -->

<div class="col-lg-6">


<b>Components:</b><br/><br/>

<table class="table">

     <tr>
   
    <td><b>Title</b></td>
    <td><b>Due Date</b></td>
    <td>
   </td>


    </td>    

    </tr> 

    @foreach ($checklist as $checklist_component)
  
    <tr>
    
    <!-- Component Title -->

    <td>{{ $checklist_component->title }}</td>
    
    <!-- Due Date -->

    <td>
    
    {{ Carbon\Carbon::parse($component->date_due)->format('D n/j') }}

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


