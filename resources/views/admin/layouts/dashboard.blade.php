@extends('admin.layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}"><strong>NERIST</strong> | NEE {!! $year=Date('Y'); !!}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{ Auth::admin()->get()->username }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        </li>
                        <li><a href="{{ url ('admin/logout') }}"><i class="fa fa-sign-out fa-fw"></i> LOGOUT</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> DASHBOARD</a>
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> MASTER ENTRY <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">EXAMINATION <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li {{ (Request::is('*index') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('admin/masterentry/exam') }}"> EXAM LIST </a>
                                        </li>
                                        <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('admin/masterentry/examdetail') }}"> EXAM DETAILS </a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">BRANCH <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('admin/masterentry/branch') }}"> BRANCH LIST </a>
                                        </li>
                                        <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('admin/masterentry/alliedbranch') }}"> ALLIED BRANCH </a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('admin/masterentry/quota' ) }}"> QUOTA </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('admin/masterentry/centre' ) }}"> CENTRE </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('admin/masterentry/centrecapacity' ) }}"> CENTRE CAPACITY </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('admin/masterentry/reservation' ) }}"> RESERVATION </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> BLOCK RESERVATION </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> QUALIFICATION </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> FORM MANAGEMENT <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.candidate.submittedform') }}"> Submitted Forms </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.candidate.nee_i_submitted') }}"> NEE I Submitted </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.candidate.nee_ii_submitted') }}"> NEE II Submitted </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.candidate.nee_iii_submitted') }}"> NEE III Submitted </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-gears fa-fw"></i> CENTRE ALLOCATION <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('panels') }}"> GENERATE ROLL NO </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> ALLOCATE CENTRE </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-search fa-fw"></i> SEARCH <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('panels') }}"> VERIFIED FORM LIST </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> VIEW FORM DETAILS </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> REPORT <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('panels') }}"> TOTAL FORM SUBMITTED </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> PAYMENT LIST </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-envelope-o fa-fw"></i> MESSAGE <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('panels') }}"> COMPOSE MESSAGE </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> VIEW MESSAGES </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> ONLINE TRASACTION <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('panels') }}"> ALL TRANSACTION </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> SUCEESS TRANSACTION </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> FAILED TRANSACTION </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> CHALLAN<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.challan.index') }}"> CHALLAN LIST </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">@yield('page_heading') &nbsp; @yield('sub_title')</h4>

                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">
            <!--Session Message Start--> 
               
              @if (Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-check"></i>{{ Session::get('message')}}
                </div>
              @endif  

            <!--Session Message End--> 

            <!--Content Section Start-->   

			@yield('section')

            <!--Content Section End-->
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

