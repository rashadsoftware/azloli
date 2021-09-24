@extends('admin.layouts.master')

@section('title', 'Poçt Oxuma')

@section('content')
	  <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('admin.layouts.mail_category')

                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-body p-0">
                            <div class="mailbox-read-info">
                                <h5 class="font-weight-bold">{{$detail->mail_theme}}</h5>
                                <h6>From: {{$detail->mail_email}}
                            </div>

                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                                <p>{{$detail->mail_text}}</p>
                                <p>Hörmətlə,<br>{{$detail->mail_user}} ({{$detail->mail_phone}})</p>
                            </div>
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.card-body -->
                    
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <a href="{{route('admin.mail')}}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Geri Qayıt</a>
                            <div class="float-right">
                                <a href="{{route('admin.mail.delete', $detail->mail_id)}}" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</a>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection