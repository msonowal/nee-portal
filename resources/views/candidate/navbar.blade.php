	<nav>
	    <div class="nav-wrapper red">
	      <a href="{{ route('index') }}" class="brand-logo" style="padding-left:10px;">NEE Portal {!! $year=Date('Y') !!}</a>
	      	<a href="#" data-activates="mobile-demo" class="button-collapse">
	      	<i class="material-icons">menu</i></a>
	      	<ul class="right hide-on-med-and-down">
	        	<li class="{{ Basehelper::isActiveRoute('candidate.home') }}"><a href="{!! route('candidate.home') !!}"> HOME </a></li>
	        	<li class="{{ Basehelper::isActiveRoute('candidate.application.dashboard') }}"><a href="{!! route('candidate.application.dashboard') !!}"> DASHBOARD </a></li>
						<li> &nbsp;&nbsp; {!! Session::get('candidate_email') !!} &nbsp;&nbsp;</li>
						<li><a href="{!! URL::route('candidate.logout') !!}"><i class="fa fa-sign-out fa-fw"></i> LOGOUT</a>
	      	</ul>
	      	<ul class="side-nav" id="mobile-demo">
	      		<li><a href="{!! route('candidate.home') !!}"> HOME </a></li>
	      		<li><a href="{!! route('candidate.application.dashboard') !!}"> DASHBOARD </a></li>
	            <li><a href="javascript:void(0)">{!! Auth::candidate()->get()->first_name !!} </a></li>
	            <li><a class="dropdown-button" href="javascript:void(0)" data-activates="dropdown2">Account
                <i class="material-icons right">arrow_drop_down</i></a></li>
	      	</ul>
	    </div>
      <!-- Dropdown Structure -->
      <ul id="dropdown2" class="dropdown-content red">
        <li><a href="javascript:void(0)">{!! Auth::candidate()->get()->first_name !!}</a></li>
        <li class="divider"></li>
        <li><a href="{!! URL::route('candidate.logout') !!}"><i class="fa fa-sign-out fa-fw"></i> LOGOUT</a>
      </ul>
  	</nav>
