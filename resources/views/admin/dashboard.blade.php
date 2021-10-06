@extends('admin.layouts.master')

@section('title', 'Ana Səhifə')

@section('css')
	@toastr_css
@endsection

@section('content')
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{DB::table('mails')->where('mail_read','unread')->count()}}</h3>

                <p>Oxunmamış Məktublar</p>
              </div>
              <div class="icon">
                <i class="fa fa-envelope"></i>
              </div>
              <a href="{{route('admin.mail')}}" class="small-box-footer">Daha ətraflı <i class="fas fa-arrow-circle-right ml-2"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{DB::table('users')->where('user_status','user')->count()}}</h3>

                <p>Bütün istifadəçilər</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{route('admin.users')}}" class="small-box-footer">Daha ətraflı <i class="fas fa-arrow-circle-right ml-2"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
		</div>
	</section>
	<!-- /.content -->
@endsection

@section('js')
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('back/')}}/js/dashboard.js"></script>
@endsection