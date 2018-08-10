<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">CRM Project</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><i class="fa fa-id-badge fa-fw"></i> {{ Auth::User()->name }}
                </li>
                <li><a href="{{ route('user.profile') }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <!--li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li-->
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
                <li class="sidebar-search">
                    {!! Form::open(['url' => 'customers', 'name' => 'searchForm', 'id' => 'searchForm']) !!}
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="customerData" minlength=5 placeholder="Search customer...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    {!! Form::close() !!}
                    <!-- /input-group -->
                </li>

                @can('role_access','view_dashboard')
                <li>
                    <a href="{{ route('home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                @endcan

                @if(Gate::check('role_access','view_user') || Gate::check('role_access','create_user'))
                <li>
                    <a href="#"><i class="fa fa-user-o fa-fw"></i> Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        @can('role_access','view_user')
                        <li>
                            <a href="{{ route('users') }}">List</a>
                        </li>
                        @endcan

                        @can('role_access', 'create_user')
                        <li>
                            <a href="{{ route('users.show_create_form') }}">Create</a>
                        </li>
                        @endcan

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif

                @if(Gate::check('role_access','view_role') || Gate::check('role_access','create_role'))
                <li>
                    <a href="#"><i class="fa fa-address-book-o fa-fw"></i> Role<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        @can('role_access','view_role')
                        <li>
                            <a href="{{ route('roles') }}">List</a>
                        </li>
                        @endcan

                        @can('role_access','create_role')
                        <li>
                            <a href="{{ route('roles.show_create_form') }}">Create</a>
                        </li>
                        @endcan

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif

                @if(Gate::check('role_access','view_permission') || Gate::check('role_access','create_permission'))
                    <li>
                        <a href="#"><i class="fa fa-address-book-o fa-fw"></i> Permission<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            @can('role_access','view_permission')
                            <li>
                                <a href="{{ route('permissions') }}">List</a>
                            </li>
                            @endcan

                            @can('role_access','create_permission')
                                <li>
                                    <a href="{{ route('permissions.show_create_form') }}">Create</a>
                                </li>
                            @endcan

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                @endif

                @if(Gate::check('role_access','view_business_unit') || Gate::check('role_access','create_business_unit'))
                <li>
                    <a href="#"><i class="fa fa-bank fa-fw"></i> Business Units<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        @can('role_access','view_business_unit')
                        <li>
                            <a href="{{ route('business_units') }}">List</a>
                        </li>
                        @endcan

                        @can('role_access','create_business_unit')
                        <li>
                            <a href="{{ route('business_units.show_create_form') }}">Create</a>
                        </li>
                        @endcan

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif

                @if(Gate::check('role_access','view_department') || Gate::check('role_access','create_department'))
                <li>
                    <a href="#"><i class="fa fa-puzzle-piece fa-fw"></i> Departments<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        @can('role_access','view_department')
                        <li>
                            <a href="{{ route('departments') }}">List</a>
                        </li>
                        @endcan

                        @can('role_access','create_department')
                        <li>
                            <a href="{{ route('departments.show_create_form') }}">Create</a>
                        </li>
                        @endcan

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif

                @if(Gate::check('role_access','view_campaign') || Gate::check('role_access','create_campaign'))
                <li>
                    <a href="#"><i class="fa fa-gears fa-fw"></i> Campaigns<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        @can('role_access','view_campaign')
                        <li>
                            <a href="{{ route('campaigns') }}">List</a>
                        </li>
                        @endcan

                        @can('role_access','create_campaign')
                        <li>
                            <a href="{{ route('campaigns.show_create_form') }}">Create</a>
                        </li>
                        @endcan

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif

                @if(Gate::check('role_access','view_disposition') || Gate::check('role_access','create_disposition'))
                <li>
                    <a href="#"><i class="fa fa-newspaper-o fa-fw"></i> Dispositions<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        @can('role_access','view_disposition')
                        <li>
                            <a href="{{ route('dispositions') }}">List</a>
                        </li>
                        @endcan

                        @can('role_access','create_disposition')
                        <li>
                            <a href="{{ route('dispositions.show_create_form') }}">Create</a>
                        </li>
                        @endcan

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif

                @if(Gate::check('role_access','view_customer') || Gate::check('role_access','create_customer'))
                <li>
                    <a href="#"><i class="fa fa-group fa-fw"></i> Customers<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        @can('role_access','view_customer')
                        <li>
                            <a href="{{ route('customers') }}">List</a>
                        </li>
                        @endcan

                        @can('role_access','create_customer')
                        <li>
                            <a href="{{ route('customers.show_create_form') }}">Create</a>
                        </li>
                        @endcan

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>