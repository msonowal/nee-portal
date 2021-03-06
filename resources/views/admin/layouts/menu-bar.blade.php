<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> DASHBOARD</a>
                        </li>
                        @if(Auth::admin()->get()->id=="1")
                        <li {{ (Request::is('*index') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin/user') }}"><i class="fa fa-user fa-fw"></i> User </a>
                        </li>
                        @endif
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
                                <!--<li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> BLOCK RESERVATION </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('buttons' ) }}"> QUALIFICATION </a>
                                </li>-->
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
                                    <a href="{{ route('admin.generate.roll_no') }}"> Roll No. Generation </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.candidate.allocate_centre') }}"> Centre Allocation </a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-search fa-fw"></i> SEARCH <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.search.submitted') }}"> SUBMITTED FORMS </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> REPORT <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.candidate.roll_no_list') }}"> Roll No. List </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.candidate.admit_card_list') }}"> Admit Card List </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.rollsheet') }}"> Roll Sheet </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.seat_label') }}"> Seat Label </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> TRASACTION <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.transaction.success') }}"> SUCCESS </a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.transaction.failed') }}"> FAILED </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> CHALLAN<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.challan.index') }}"> Challan Import </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.challan.pending') }}"> Challan Pending </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.access.user_account') }}"> Challan verification </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> Result<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                             @if(Auth::admin()->get()->id=="1")
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.import.result') }}"> Import Result</a>
                                </li>
                             @endif   
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_i.selected') }}"> NEE I Selected </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_i.wait_listed') }}"> NEE I Wait Listed </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_i.wait_listed_extended') }}"> NEE I Wait Listed(Extended) </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_ii_pcb.selected') }}"> NEE II(Forestry) Selected </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_ii_pcb.wait_listed') }}"> NEE II(Forestry) Wait Listed </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_ii_pcb.wait_listed_extended') }}"> NEE II(Forestry) Wait Listed(Extended) </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_ii_pcm_voc.selected') }}"> NEE II(Tech) Selected </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_ii_pcm_voc.wait_listed') }}"> NEE II(Tech) Wait Listed </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_ii_pcm_voc.wait_listed_extended') }}"> NEE II(Tech) Wait Listed(Extended) </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_iii.selected') }}"> NEE III Selected </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_iii.wait_listed') }}"> NEE III Wait Listed </a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.nee_iii.wait_listed_extended') }}"> NEE III Wait Listed(Extended) </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> Address<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ route('admin.address.list') }}"> Address Label </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->