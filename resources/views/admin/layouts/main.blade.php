@extends('admin.layouts.plane')
@section('body')
<style type="text/css">
    .navbar{
        background-color: #F44336 !important;
        height: 70px;
    }
    .a-nav{
        color: #ffffff !important;
    }
    h3, .h3{
        margin-top: 3px !important;
        margin-bottom: 10px !important; 
    }
</style>
 <div id="wrapper">
        @include('admin.layouts.nav-bar')
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

