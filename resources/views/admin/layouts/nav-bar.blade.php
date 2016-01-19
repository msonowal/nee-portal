    <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand a-color h3" href="{{ route('admin.dashboard') }}"><h3><strong>NERIST</strong> | NEE {!! $year=Date('Y'); !!}</h3></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            
                <li class="dropdown">
                    <a class="dropdown-toggle a-color" data-toggle="dropdown" href="#">
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
            <br/>
            @include('admin.layouts.menu-bar')
        </nav>