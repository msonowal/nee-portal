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
      <header> @include('candidate.navbar') </header>
    <main>
    <div class="container">

    @if(Session::has('message'))
      <div class="card-panel blue darken-1" style="padding:5px 10px;">
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

      <!--Import jQuery before materialize.js-->
    </main>
    @include('layouts.footer')
    <script type="text/javascript" src="{{ asset("frontend/JQuery/jQuery-2.1.4.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("frontend/js/materialize.min.js") }}"></script>
    <script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/js/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset("frontend/js/jquery.blockUI.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("frontend/js/custom.js") }}"></script>

    @yield('script')
    <script type="text/javascript">
      $(document).ready(function(){

        $(".button-collapse").sideNav(); //Navbar
        $(".dropdown-button").dropdown(); //Dropdown
        $('select').material_select(); //Metrial Select

        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: 15,
            max: new Date(2003,1,10),
            format: 'dd-mm-yyyy' // Datepicker
        });
        $('.tooltipped').tooltip({delay: 50}); //Tooltip
        $('.modal-trigger').leanModal(); //Trigger Model
        //$.blockUI({ message: '<h1><img src="busy.gif" /> Just a moment...</h1>' });
        //$.blockUI({ message: '<div class="preloader-wrapper big active"><div class="spinner-layer spinner-blue"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div>'});
        //$.blockUI({ message: '<div class="progress"><div class="indeterminate"></div></div>'});
        $(document).ajaxStart(function () {$.blockUI({ message: '<div class="preloader-wrapper active"><div class="spinner-layer spinner-red-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>'});});
        $(document).ajaxStop($.unblockUI);
        @yield('page_script')
        //$('textarea').characterCounter();
        //$('input#input_text, textarea#textarea1').characterCounter();
    });
  </script>
    </body>
  </html>
