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
<!--     <link href="{{ asset('css/smt-bootstrap.css') }}" rel="stylesheet">
 -->    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
  
      <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>

<body>

<div id="app">

<!-- Begin Tailwind Header -->

<div class="bg-black mx-auto text-white py-5 px-5 lg:max-w-4xl">
    
    <span class="text-3xl">
        <a class="text-grey-light hover:no-underline hover:text-white" href="{{ url('/home') }}">{{ config('app.name', 'Laravel') }}</a>
    </span>


    @if (Auth::guest())

     <!-- Hamburger Menu-->
     <!--<button class="float-right pr-4 md:hidden bg-grey-darker hover:bg-blue-dark text-white font-bold py-2 px-4 rounded">
    Register
     </button> -->

    <div class="float-right mt-1">
  
    <a class="text-grey-light bg-grey-darker hover:bg-grey-dark hover:text-white hover:no-underline px-2 py-2 rounded" href="{{route('registerStudent')}}">
    
    Register</a>
        
    </div>

     @else


    <span class="float-right text-white mt-1">
    {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
    
    <a class="text-grey-light bg-grey-darker hover:bg-grey-dark hover:text-white hover:no-underline px-2 py-2 ml-2 rounded" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Logout</a></span>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    </form>

    @endif

    </div>


<!-- End Tailwind Header-->

<!-- Begin Original Nav -->

        <!-- Flash Messages -->

    @if (session()->has('flash_notification.message'))

    <div class="bg-white mx-auto text-dark-grey py-5 px-5 lg:max-w-4xl">

        <div class="container">
          <div class="alert alert-{{ session('flash_notification.level') }}">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

    {!! session('flash_notification.message') !!}

        </div>
        </div>
    </div>

    @endif

        <!-- Content -->

         <!-- <a class="text-2xl pr-4 text-black hover:no-underline hover:text-grey-darker" href="{{ route('registerTeacher') }}">Register Teacher</a>

         <a class="text-2xl pr-4 text-black hover:no-underline hover:text-grey-darker" href="{{ route('registerStudent') }}">Register Student</a>
 -->
        <div class="bg-grey-lightest mx-auto text-grey-dark py-5 px-5 lg:max-w-4xl">

        @yield('content')  
        
        </div>

        </div>  

           <!--  <div class="container">
            <div class="row">
            <div class="col-md-12">
            @include('layouts.partials.footer')
            </div></div></div> -->

</div>


    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/Pikaday-master/pikaday.js') }}"></script>
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
