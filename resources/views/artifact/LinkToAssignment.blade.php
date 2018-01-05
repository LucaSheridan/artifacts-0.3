

Choose an Assignment to Link this Artifact to:

{{ $artifact->id }}

<ul>

@foreach ($assignments as $assignment)

<li>

<a href="{{ url(linkTo$assignment->id => $assignment )}}">{{$assignment->title}}</a>
</li>



@endforeach

</ul>