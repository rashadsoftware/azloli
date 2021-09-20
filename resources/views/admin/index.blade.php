@include('admin.layouts.headTag')
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <div><b>Admin Panel</b></div>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sistemə girmək üçün daxil olmalısınız</p>

                    <form action="{{route('admin.index.post')}}" method="post" autocomplete="off">
                        @csrf

                        @if($message=Session::get('fail'))
                        <div class="w-100 mt-1">
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{old('email')}}">
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Şifrə" name="password">
                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Giriş</button>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{asset('back/')}}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('back/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('back/')}}/js/adminlte.min.js"></script>
    </body>
</html>
