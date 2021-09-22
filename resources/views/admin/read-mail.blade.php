@extends('admin.layouts.master')

@section('title', 'Poçt Oxuma')

@section('content')
	  <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('admin.mail')}}" class="btn btn-primary btn-block mb-3">Geri Dön</a>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dosyalar</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item active">
                                    <a href="{{route('admin.mail')}}" class="nav-link">
                                        <i class="fas fa-inbox"></i> Gələnlər Qutusu
                                        @if(DB::table('mails')->where('mail_read', 'unread')->count() > 0)
                                        <span class="badge bg-primary float-right">{{DB::table('mails')->where('mail_read', 'unread')->count()}}</span>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-body p-0">
                            <div class="mailbox-read-info">
                                <h5 class="font-weight-bold">{{$detail->mail_theme}}</h5>
                                <h6>From: {{$detail->mail_email}}
                                <span class="mailbox-read-time float-right">{{$detail->created_at}}</span></h6>
                            </div>

                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                              <p>{{$detail->mail_text}}</p>
                              <p>Hörmətlə,<br>{{$detail->mail_user}}</p>
                            </div>
                            <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.card-body -->
                    
                    <!-- /.card-footer -->
                    <div class="card-footer">
                      <div class="float-right">
                        <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                        <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
                      </div>
                      <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
                      <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
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