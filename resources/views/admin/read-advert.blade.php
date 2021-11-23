@extends('admin.layouts.master')

@section('title', 'Təklif Oxuma')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{route('admin.advert')}}">
        İş Təklifləri
    </a>
</li>
@endsection

@section('content')
	  <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body p-0">
                            <div class="mailbox-read-info d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="font-weight-bold"> {{$detail->advert_title}}</h5>
                                    <h6>Kimdən: {{$detail->advert_name}}
                                </div> 
                                @if($detail->advert_status == 'waiting')                               
								<div>
									<a href="{{route('admin.advert.confirm', $detail->advert_id)}}" class="btn btn-success"><i class="fas fa-check mr-2"></i> Təsdiqlə</a>
									<a href="{{route('admin.advert.cancel', $detail->advert_id)}}" class="btn btn-success"><i class="fas fa-exclamation mr-2"></i> İmtina et</a>
								</div>		
                                @endif						
                            </div>

                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                                <p class="mb-3">{{$detail->advert_description}}</p>

                                @if ($detail->advert_images != '')
                                    @php $images=json_decode($detail->advert_images); @endphp
                                        
                                    @php for($m=0; $m < count($images); $m++ ){  @endphp
                                            <img src="{{asset('front/')}}/img/adverts/{{$images[$m]}}" alt="" style="width:100px" class="mr-2">
                                    @php    
                                        }
                                    @endphp
                                @endif

                                <p class="mt-3">Hörmətlə,<br>{{$detail->advert_name}} @if($detail->advert_phone != '') ({{$detail->advert_phone}})  @endif</p>
                            </div>
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.card-body -->
                    
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <a href="{{route('admin.advert')}}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Geri Qayıt</a>
                            <div class="float-right">
                                <a href="{{route('admin.advert.delete', $detail->advert_id)}}" class="btn btn-danger"><i class="far fa-trash-alt"></i> Təklifi Sil</a>
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