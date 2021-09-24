@extends('admin.layouts.master')

@section('title', 'Poçt Qutusu')

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
                @include('admin.layouts.mail_category')                

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gələnlər Qutusu</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="exampleDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Gələn Məktublar</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mails as $mail)
                                    <tr>
                                        <td class="mailbox-subject">
                                            <b>
                                                @if($mail->mail_read == 'unread')
                                                    Yeni Mesaj - 
                                                @endif
                                            </b>{{Str::substr($mail->mail_text, 0, 70)}}...
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('admin.mail.show', $mail->mail_id)}}" title="Yenilə" class="btn btn-default mr-1"><i class="fas fa-eye"></i></a>
                                            <a href="{{route('admin.mail.delete', $mail->mail_id)}}" title="Sil" class="btn btn-danger mr-1"><i class="fas fa-trash-alt"></i></a>
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