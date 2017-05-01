@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
            <div class="panel-heading">Site Index</div>
            <div class="panel-body">
           
            <table class='table'>
            <thead>
            <tr>
            <td>
            Name
            </td>
            <td>
            Teachers 
            </td>
             <td>
            Students
            </td>
            <td>Delete
            </td>
            <td>Edit
            </td>
            </tr>
            </thead>
            
            @foreach ($sites as $site)
            <tr>
            <td>
            <a href='{{ action('SiteController@show', $site->id) }}'>{{ $site->name}}<a>
            </td>
            <td>
          

                @php ($i = 0)
               
                @foreach ($site->users as $user)

                    @if ( $user->hasRole('teacher')) 

                        @php ( $i++ )

                    @endif

                @endforeach

                {{ $i }}
                @php ($i = 0)

        </td>
            <td>
              
                @php ($i = 0)
               
                @foreach ($site->users as $user)

                    @if ( $user->hasRole('student')) 
                    @php ($i++)
                    @endif

                @endforeach

                {{ $i }}
                
                @php ($i = 0)

             </td>
             <td>
             <a href='{{ action('SiteController@delete', $site->id) }}'>Delete<a>
             </td>
            </td>
                <td><a href='{{ action('SiteController@edit', $site->id) }}'>Edit<a></td>
            </tr>
            
            @endforeach
            </table>

            {{ $sites->links() }}

            <br/>
            <a href='{{ action('SiteController@create') }}' class='btn btn-primary'>Create a New Site</a>
            
            </div>            
            </div>
        </div>
    </div>
</div>
@endsection

