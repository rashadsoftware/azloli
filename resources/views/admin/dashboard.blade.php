@extends('admin.layouts.master')

@section('title', 'Ana Səhifə')

@section('css')
	@toastr_css
@endsection

@section('content')
	<!-- Main content -->
	<section class="content">

	</section>
	<!-- /.content -->
@endsection

@section('js')
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('back/')}}/js/dashboard.js"></script>
@endsection