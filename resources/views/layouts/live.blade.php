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
        <marquee> NEE Online Portal will be live on 11th of January 2016</marquee></h5>
      </div>
     <div class="center">
      <a href="{!! URL::route('candidate.register') !!}" class="waves-effect waves-light btn blue"><i class="large material-icons">mode_edit</i>Register</a> &nbsp;
      <a href="{!! URL::route('candidate.login') !!}" class="waves-effect waves-light btn blue">Login</a>
    </div>
  </div>
 </div>   
</main>
@include('layouts.footer')
<script type="text/javascript" src="{{ asset("frontend/js/jquery-2.1.1.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("frontend/js/materialize.min.js") }}"></script>
<script type="text/javascript"> $(document).ready(function(){ $('.button-collapse').sideNav(); }); </script>
  </body>
</html>
