<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pikaday.css') }}" rel="stylesheet">
    <link href="{{ asset('css/smt-bootstrap.css') }}" rel="stylesheet">
  
      <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <style>
    html, body {
      height: 100%;
    }
    #actions {
      margin: 2em 0;
    }
    /* Mimic table appearance */
    div.table {
      display: table;
    }
    div.table .file-row {
      display: table-row;
    }
    div.table .file-row > div {
      display: table-cell;
      vertical-align: top;
      border-top: 1px solid #ddd;
      padding: 8px;
    }
    div.table .file-row:nth-child(odd) {
      background: #f9f9f9;
    }
    /* The total progress gets shown by event listeners */
    #total-progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }
    /* Hide the progress bar when finished */
    #previews .file-row.dz-success .progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }
    /* Hide the delete button initially */
    #previews .file-row .delete {
      display: none;
    }
    /* Hide the start and cancel buttons and show the delete button */
    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
      display: none;
    }
    #previews .file-row.dz-success .delete {
      display: block;
    }
  </style>

</head>
<body>

<div id="app">

<nav class="navbar navbar-default navbar-static-top">

<div class="container">

<div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

</div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">&nbsp;
            </ul>

             <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
            
            <!-- Authentication Links -->
               
                    @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            
                             <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Register<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                     <li><a href="{{ route('registerStudent') }}">Register Student</a></li>
                                     <li><a href="{{ route('registerTeacher') }}">Register Teacher</a></li>
                                </ul>
                            </li>


                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->firstName }} {{ Auth::user()->lastName }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    
                                        
                                        @if ( Auth::User()->hasRole('student'))

                                        <li>

                                        <a href="{{ url('/enroll')}}">Join another class</a>

                                        </li>
                                        @else
                                        @endif

                                    

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->

    @if (session()->has('flash_notification.message'))

    <div class="container">
        <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

    {!! session('flash_notification.message') !!}

        </div>
    </div>

    @endif

        <!-- Content -->

        @yield('content')    

            <div class="container">
            <div class="row">
            <div class="col-md-12">
            @include('layouts.partials.footer')
            </div></div></div>

</div>


    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/pikaday.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

    <script>
    var picker = new Pikaday({ field: $('#datepicker')[0] });
    </script>
    
    <script src="https://unpkg.com/vue@2.1.10/dist/vue.js"></script>
   




</body>
</html>