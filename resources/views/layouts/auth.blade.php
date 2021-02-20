<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/now-ui-kit.min.css')}}" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
        <div class="navbar-translate">
            @if ( request()->is('login') )
            <a class="navbar-brand" href="/login" rel="tooltip" data-placement="bottom">
                Form Login
            </a>
            @else
            <a class="navbar-brand" href="/register" rel="tooltip" data-placement="bottom">
                Form Register
            </a>
            @endif
            
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image:url(../assets/img/logo.png)"></div>
    <div class="content">
        <div class="container">
            <div class="col-md-4 ml-auto mr-auto">
                <div class="card card-login card-plain">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
    <div class=" container ">
        <div class="copyright" id="copyright">
        &copy;
        <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
        </script>, Coded by
        <a href="#" >Farid Rizky Wijaya</a>.
        </div>
    </div>
    </footer>
</div>
</body>
</html>