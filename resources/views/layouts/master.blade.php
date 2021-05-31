<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>StarAndDaisy Inventory</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/lib/weather-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
        

        <link rel="stylesheet" href="{{ asset('assets/css/lib/font-awesome.min.css') }}">
        
        <link rel="stylesheet" href="{{ asset('assets/css/lib/menubar/sidebar.css') }}">
        
        <link rel="stylesheet" href="{{ asset('assets/css/lib/helper.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<!-- <script src="{{ asset('assets/js/lib/jquery.min.js') }}" defer></script> -->
        
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
   
        @include('sweetalert::alert')
        
        
        

    </head>



    <body>
		<!-- /# sidebar -->
       <!-- @include('layouts.side-nav') -->
        <!-- /# sidebar -->
        @include('layouts.head')
<!-- <div class="container"> -->
         @yield('content')
        
<!-- </div> -->
      <!-- jquery vendor -->
        
         <script src="{{ asset('assets/js/lib/jquery.nanoscroller.min.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/menubar/sidebar.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/preloader/pace.min.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/circle-progress/circle-progress.min.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/circle-progress/circle-progress-init.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/morris-chart/raphael-min.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/morris-chart/morris.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/morris-chart/morris-init.js') }}" defer></script>
          <!--  flot-chart js -->
         <script src="{{ asset('assets/js/lib/flot-chart/jquery.flot.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/flot-chart/jquery.flot.resize.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/flot-chart/flot-chart-init.js') }}" defer></script>
         <!-- // flot-chart js -->
         <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.min.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.sampledata.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.world.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.algeria.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.argentina.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.brazil.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.france.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.germany.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.greece.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.iran.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.iraq.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.russia.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.tunisia.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.europe.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.usa.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/vector-map/vector.init.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/weather/jquery.simpleWeather.min.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/weather/weather-init.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/owl-carousel/owl.carousel.min.js') }}" defer></script>
         <script src="{{ asset('assets/js/lib/owl-carousel/owl.carousel-init.js') }}" defer></script>
         <script src="{{ asset('assets/js/scripts.js') }}" defer></script>
    </body>
</html>
