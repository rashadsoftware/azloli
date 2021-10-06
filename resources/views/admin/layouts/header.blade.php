    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('admin.dashboard')}}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">Ana Səhifə</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                @php $mailCount = DB::table('mails')->where('mail_read','unread')->count(); @endphp

                @php $optional_count=$mailCount @endphp
                <li class="nav-item dropdown mr-2">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        
                        <span class="badge badge-warning navbar-badge">{{$optional_count}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- all notificaions -->
                        <span class="dropdown-item dropdown-header">{{$optional_count}} Bildirişiniz var</span>
                        <div class="dropdown-divider"></div>

                        <!-- mail notificaions -->
                        @if($mailCount > 0)
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-envelope mr-2"></i> {{$mailCount}} yeni ismarıc
                        </a>
                        <div class="dropdown-divider"></div>
                        @endif
                    </div>
                </li>
                <li>
                    <a href="{{route('index')}}" class="btn btn-primary">Sayta Qayıt</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('admin.dashboard')}}" class="brand-link">
                <img src="{{asset('back/')}}/img/AdminLTELogo.png" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Panel</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if($user->user_image == '')
                            <img src="{{asset('back/')}}/img/icons/user.jpg" class="img-circle elevation-2" alt="{{$user->user_name}}">
                        @else
                            <img src="{{asset('back/')}}/img/users/{{ $user->user_image }}" class="img-circle elevation-2" alt="{{$user->user_name}}">
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{route('admin.profile')}}" class="d-block">{{$user->user_name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{route('admin.dashboard')}}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" >
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Ana Səhifə</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users')}}" class="nav-link {{ Route::is('admin.users') ? 'active' : '' }}" >
                                <i class="nav-icon fas fa-users"></i>
                                <p>İstifadəçilər</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.mail')}}" class="nav-link {{ Route::is('admin.mail') ? 'active' : '' }}" >
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Poçt Qutusu</p>
                                @if(DB::table('mails')->where('mail_read', 'unread')->count() > 0)
                                <span class="badge badge-info right">{{DB::table('mails')->where('mail_read', 'unread')->count()}}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-header">Sayt Tənzimləmələri</li>
						<li class="nav-item @if(Request::segment(2) == 'category') menu-open @endif">
                            <a href="#" class="nav-link  @if(Request::segment(2) == 'category') active @endif">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Kateqoriyalar
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.category') }}" class="nav-link {{ Route::is('admin.category') || Route::is('admin.category.edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="text-capitalize">Bütün Kateqoriyalar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.category.create') }}" class="nav-link {{ Route::is('admin.category.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="text-capitalize">Kateqoriya yarat</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
						<li class="nav-item @if(Request::segment(2) == 'subcategory') menu-open @endif">
                            <a href="#" class="nav-link  @if(Request::segment(2) == 'subcategory') active @endif">
                                <i class="nav-icon fas fa-stream"></i>
                                <p>
                                    Alt Kateqoriyalar
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.subcategory') }}" class="nav-link {{ Route::is('admin.subcategory') || Route::is('admin.subcategory.edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="text-capitalize">Bütün Alt Kateqoriyalar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.subcategory.create') }}" class="nav-link {{ Route::is('admin.subcategory.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="text-capitalize">Alt Kateqoriya yarat</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.settings')}}" class="nav-link {{ Route::is('admin.settings') ? 'active' : '' }}">
                                <i class="fas fa-cog"></i>
                                <p>Sayt Tənzimləmələri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-danger text-center" href="{{route('admin.logout')}}" role="button">
                                <i class="fas fa-sign-out-alt mr-1"></i>
                                <p>Sistemdən Çıxış</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.dashboard')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                @yield('breadcrumb')
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>