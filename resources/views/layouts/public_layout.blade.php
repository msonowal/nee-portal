<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>NEE ONLINE Portal {{ date('Y') }}</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="{{ asset("frontend/css/materialize.min.css") }}"  media="screen,projection"/>
  <link href="{{ asset("frontend/css/style.css") }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
  <div class="navbar-fixed">
  <nav class="purple lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">NEE ONLINE 2016</a>
      @yield('menus')
    </div>
  </nav>
  </div>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h3 class="header center red-text">
        <img src="{{ asset('images/nee_logo.png')}}" alt="NERIST LOGO">
        <br/>
        {{ date('Y') }}-{{ date('Y')+1}}
      </h3>
      <div class="row center">
        <h5 class="header col s12 light">North East Regional Institute of Science and Technology, Nirjuli (Itanagar) <br />
        <marquee> NEE Online Portal will be live on 11th of January 2016</marquee>
      </div>

      <br>
    </div>
  </div>

  <div class="container">
    @yield('container')
  </div>

  <footer class="page-footer red">
    <div class="container">
      <div class="row">
        @yield('footer')
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      &copy; Copyright 2016 NERIST, Powered by
      <a class="white-text text-lighten-3" href="http://www.zantrik.in" target="_blank">Infotech Solution</a>
      </div>
    </div>
  </footer>
  <!--  Scripts-->
  <script type="text/javascript" src="{{ asset("frontend/js/jquery-2.1.1.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("frontend/js/materialize.min.js") }}"></script>
  <script type="text/javascript"> $(document).ready(function(){ $('.button-collapse').sideNav(); }); </script>
  </body>
</html>
