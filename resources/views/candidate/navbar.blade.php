<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="#!">{!! Auth::candidate()->get()->first_name !!}</a></li>
  <li><a href="#!">Profile</a></li>
  <li class="divider"></li>
  <li><a href="{!! URL::route('candidate.logout') !!}"><i class="fa fa-sign-out fa-fw"></i> LOGOUT</a>
</ul>
<ul id="dropdown2" class="dropdown-content">
  <li><a href="#!">{!! Auth::candidate()->get()->first_name !!}</a></li>
  <li><a href="#!">Profile</a></li>
  <li class="divider"></li>
  <li><a href="{!! URL::route('candidate.logout') !!}"><i class="fa fa-sign-out fa-fw"></i> LOGOUT</a>
</ul>
	<nav>
	    <div class="nav-wrapper blue darken-1">
	      <a href="#!" class="brand-logo" style="padding-left:10px;">NEE Portal {!! $year=Date('Y') !!}</a>
	      	<a href="#" data-activates="mobile-demo" class="button-collapse">
	      	<i class="material-icons">menu</i></a>
	      	<ul class="right hide-on-med-and-down">
	        	<li><a href="{!! route('candidate.home') !!}"> HOME </a></li>
	        	<li><a href="{!! route('candidate.application.dashboard') !!}"> DASHBOARD </a></li>
	        	<li><a href="#">{!! Auth::candidate()->get()->first_name !!} </a></li>
	        	<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Account<i class="material-icons right">arrow_drop_down</i></a></li>
	      	</ul>
	      	<ul class="side-nav" id="mobile-demo">
	      		<li><a href="{!! route('candidate.home') !!}"> HOME </a></li>
	      		<li><a href="{!! route('candidate.application.dashboard') !!}"> DASHBOARD </a></li>
	            <li><a href="#">{!! Auth::candidate()->get()->first_name !!} </a></li>
	            <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Account<i class="material-icons right">arrow_drop_down</i></a></li>
	      	</ul>
	    </div>
  	</nav>
