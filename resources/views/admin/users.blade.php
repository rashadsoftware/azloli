@extends('admin.layouts.master')

@section('title', 'İstifadəçilər')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	
	<!-- Bootstrap Toggle -->
	<link rel="stylesheet" href="{{asset('back/')}}/plugins/bootstrap-toggle/bootstrap-toggle.min.css">
@endsection

@section('content')
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bütün İstifadəçilər</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="exampleDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>İstifadəçi adı</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userall as $userone)
                                    <tr>
                                        <td>{{$userone->user_name}}</td>
                                        <td>{{$userone->user_email}}</td>
                                        <td class="text-center"> 
											<input type="checkbox" data-id="{{$userone->user_id}}" data-toggle="toggle" data-off="Passiv" data-on="Aktiv" class="toggleUser" data-size="normal" @if($userone->user_state == 'active') ? checked : '' @endif>
										</td>
                                        <td class="text-center">
                                            <a href="{{route('admin.users.delete', $userone->user_id)}}" title="Sil" class="btn btn-danger mr-1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
		</div>
	</section>
	<!-- /.content -->
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('back/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<!-- Bootstrap Switch -->
<script src="{{asset('back/')}}/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<script>
    $(function () {
        // dataTable
        $("#exampleDataTable").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
		
		// bootstrap toggle event
        $(".toggleUser").on('change', function(){
            var getID=$(this).attr('data-id');
            var getStatus=$(this).prop('checked');

            $.get("{{route('admin.users.toggle')}}", {getID:getID, getStatus:getStatus} , function(data, status){
                console.log(data);
            });
        });
    })
</script>
@endsection