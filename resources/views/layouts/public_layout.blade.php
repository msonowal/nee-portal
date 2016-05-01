<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>NEE ONLINE Portal {{ date('Y') }}</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="{{ asset("frontend/css/materialize.min.css") }}"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="{{ asset("frontend/css/custom.css") }}" />
  <link href="{{ URL::asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset("frontend/css/style.css") }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="google-site-verification" content="AJiTML964ODyVFzuI_sEuc8YMQAEPlcEf70uTjRpxMY"/>
</head>
<body>
  <header>
  @include('layouts.navbar')
</header>
<main>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h3 class="header center red-text">
        <img src="{{ asset('images/nee_logo.png')}}" alt="NERIST LOGO">
        <br/>
        {{ date('Y') }}-{{ date('Y')+1}}
      </h3>
      <div class="row center">
        <h5 class="header col s12 light">North Eastern Regional Institute of Science and Technology, Nirjuli (Itanagar) <br />
        <!--<marquee> NERIST Entrance Examination (NEE) 2016 for the sesion 2016-17</marquee>-->
        <!--<marquee><h4 class="header center red-text"> The Challan verification process will be close soon. It is requested to verify (for those who paid through Challan and did not get registration confirmation page yet) yourself or email us scan copy of Challan with email id, password and exam name in support@neeonline.ac.in</h4></marquee>-->
        <!--<marquee><h4 class="header center red-text">Admit Card for NEE {{ date('Y') }} can be downloaded with effect from 31-03-2016.</h4></marquee>-->
        <!--<marquee><h4 class="header center red-text">Admit Card for NEE {{ date('Y') }}  is available for download after login.</h4></marquee>-->
        <h4 class="header center red-text"><a href="https://nerist.ac.in/link/result/" target="_blank"> Results of NEE 2016 </a></h4>
        </h5>
      </div>
      <!--##### -->
      @yield('body')
      
  </div>
 </div>   
</main>
@include('layouts.footer')
<script type="text/javascript" src="{{ asset("frontend/js/jquery-2.1.1.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("frontend/js/materialize.min.js") }}"></script>
<script type="text/javascript"> $(document).ready(function(){ $('.button-collapse').sideNav(); }); </script>
  </body>
</html>
