<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta charset="utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/now-ui-dashboard.min.css')}}" rel="stylesheet" />
    
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
  </head>
  <body>
    <div class="wrapper ">
      <x-sidebar></x-sidebar>
      <div class="main-panel" id="main-panel">
        <x-nav></x-nav>
        <div class="panel-header panel-header-{{ request()->is('dashboard') ? 'lg' : 'sm' }}">
          @yield('chart')
        </div>
          
        <div class="content">
            {{-- <div class="card"> --}}
              @yield('content')
            {{-- </div> --}}
          </div>
          
          <x-footer></x-footer>
        </div>
      </div>
      <!--   Core JS Files   -->
      
      <script src="{{ asset('assets/js/core/jquery.min.js')}}"></script>
      <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
      <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
      <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

      <!-- Chart JS -->
      {{-- <script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script> --}}
      <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
      <script src="{{ asset('assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
      
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    </body>
      </html>
      