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
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">10</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- all notificaions -->
                        <span class="dropdown-item dropdown-header">10 Bildiriş</span>
                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="fab fa-magento mr-2"></i> 5 yeni agentlik
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="fas fa-copy mr-2"></i> 5 yeni elan
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
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
                        <a href="#" class="d-block">{{$user->user_name}}</a>
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
                        <li class="nav-header">Sayt Tənzimləmələri</li>
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