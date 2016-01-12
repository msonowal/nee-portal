<!DOCTYPE html>
  <html>
    <head>
      <title> NEE Portal {!! date('Y') !!}</title>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="{{ asset("frontend/css/materialize.min.css") }}"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="{{ asset("frontend/css/custom.css") }}" />
      <link href="{{ URL::asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
      <header>
        @include('layouts.navbar')
      </header>
    <main>
      <div class="container">
      @if(Session::has('message'))
      <div class="card-panel green darken-1" style="padding:5px 10px;">
       <p class="white-text">
       {!! Session::get('message') !!}
       </p>
      </div>
      @endif
      @if(count($errors)>0)
      <div class="card-panel red darken-1" style="padding:1px 15px;">
       <span class="white-text">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
      </span>
      </div>
      @endif
            @yield('body')
      </div>
      </main>
      @include('layouts.footer')
      <script type="text/javascript" src="{{ asset("frontend/js/jquery-2.1.1.min.js") }}"></script>
      <script type="text/javascript" src="{{ asset("frontend/js/materialize.min.js") }}"></script>
      <script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/js/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset("frontend/js/jquery.blockUI.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("frontend/js/custom.js") }}"></script>
      <script type="text/javascript">
      $(document).ready(function(){
          $(".button-collapse").sideNav();
          $(".dropdown-button").dropdown();
          $('select').material_select();
          @yield('page_script')
      });
      </script>
    </body>
  </html>
