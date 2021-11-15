@extends('admin.layouts.master')

@section('title', 'İş Təklifləri')

@section('css')
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{asset('back/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
	<!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gələn İş Təklifləri</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="exampleDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>İş Təklifləri</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($adverts as $advert)
                                    <tr>
                                        <td class="mailbox-subject">
                                            <b>
                                                @if($advert->advert_read == 'unread')
                                                    Yeni Təklif - 
                                                @endif
                                            </b>{{Str::substr($advert->advert_description, 0, 70)}}...
                                        </td>
										<td class="text-center">
											@if($advert->advert_status == 'waiting')
												<span class="text-primary">Təsdiq gözləyir</span>
											@elseif($advert->advert_status == 'active')
												<span class="text-success">Təsdiqləndi</span>
											@else
												<span class="text-danger">Ləğv edildi</span>
											@endif
										</td>
                                        <td class="text-center">
											<a href="{{route('admin.advert.show', $advert->advert_id)}}" title="Oxu" class="btn btn-default mr-1"><i class="fas fa-eye"></i></a>
                                            <a href="{{route('admin.advert.delete', $advert->advert_id)}}" title="Sil" class="btn btn-danger mr-1"><i class="fas fa-trash-alt"></i></a>
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
            <!-- /.row -->
        </div>        
    </section>
    <!-- /.content -->
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('back/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

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

        //Enable check and uncheck all functionality
        $('.checkbox-toggle').click(function () {
            var clicks = $(this).data('clicks')
            if (clicks) {
                //Uncheck all checkboxes
                $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
            } else {
                //Check all checkboxes
                $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
            }
            $(this).data('clicks', !clicks)
        })

        //Handle starring for font awesome
        $('.mailbox-star').click(function (e) {
            e.preventDefault()
            //detect type
            var $this = $(this).find('a > i')
            var fa    = $this.hasClass('fa')

            //Switch states
            if (fa) {
                $this.toggleClass('fa-star')
                $this.toggleClass('fa-star-o')
            }
        })
    })
</script>
@endsection