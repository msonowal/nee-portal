<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <title>NEE Portal {!! $year=Date('Y') !!}</title>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="{{ asset("frontend/css/materialize.min.css") }}"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
    <nav>
	    <div class="nav-wrapper">
	      <a href="#!" class="brand-logo">NEE Portal {!! $year=Date('Y') !!}</a>
	      	<a href="#" data-activates="mobile-demo" class="button-collapse">
	      	<i class="material-icons">menu</i></a>
	      	<ul class="right hide-on-med-and-down">
	        	<li><a href="#">ADMISSIONS</a></li>
	        	<li><a href="#">BROCHURE</a></li>
	        	<li><a href="#">EXAM SCHEDULE</a></li>
	        	<li><a href="#">CONTACT</a></li>
	      	</ul>
	      	<ul class="side-nav" id="mobile-demo">
	            <li><a href="#">ADMISSIONS</a></li>
	        	<li><a href="#">BROCHURE</a></li>
	        	<li><a href="#">EXAM SCHEDULE</a></li>
	        	<li><a href="#">CONTACT</a></li>
	      	</ul>
	    </div>
  	</nav>          
		<div>
  			<h3 class="center-align">ADMISSIONS {!! $year=Date('Y') !!}</h3>
		</div>
		<div class="center">
			<a href="{!! URL::route('student.register') !!}" class="waves-effect waves-light btn"><i class="large material-icons">mode_edit</i>Register</a>
			<a href="{!! URL::route('student.login') !!}" class="waves-effect waves-light btn">Login</a>
		</div>
		
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="{{ asset("frontend/js/jquery-2.1.1.min.js") }}"></script>
      <script type="text/javascript" src="{{ asset("frontend/js/materialize.min.js") }}"></script>
      <script type="text/javascript">

      $(document).ready(function(){
      		$(".button-collapse").sideNav();
      });

      </script>
    </body>
  </html>