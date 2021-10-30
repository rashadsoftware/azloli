@extends('admin.layouts.master')

@section('title', 'Haqqımızda')


@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">Missiyamız</h3>
                    </div>
                        <!-- /.card-header -->

                    <!-- form start -->
                    <form autocomplete="off" action="{{route('admin.pages.about.update')}}" method="POST">
                        @method('PUT')  
                        @csrf
                        <div class="card-body"> 
                            <div class="form-group">
                                <label>Başlıq</label>
                                <select class="form-control @error('cat_title') is-invalid @enderror" name="cat_title">
                                    <option value="">Başlıq seçin</option>
                                    <option value="first_title">Başlıq 1</option>
                                    <option value="second_title">Başlıq 2</option>
                                    <option value="third_title">Başlıq 3</option>
                                </select>
                                <span class="text-danger">@error('cat_title') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label>Detaylar</label>
                                <textarea class="form-control @error('cat_desc') is-invalid @enderror" rows="7" placeholder="Başlıq haqqında ətraflı məlumat daxil edin" name="cat_desc"></textarea>
                                <span class="text-danger">@error('cat_desc') {{$message}} @enderror</span>
                            </div>                 
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Missiya Yarat</button>
                        </div>
                    </form>                                
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{route('admin.pages.about.image.mission')}}" method="POST" class="mb-3" id="formImageMission">
                            @method('PUT')
                            @csrf
                            <div class="form-inline">
                                <input class="form-control" type="file" name="imageMission" onchange="document.getElementById('previewMission').src = window.URL.createObjectURL(this.files[0])">                                            
                                <button type="submit" class="btn btn-primary ml-3">Missiya Şəkli Yerləşdir</button>
                            </div>  
                            <span class="text-danger error-text imageMission_error"></span>                                                       
                        </form>
                        <form enctype="multipart/form-data" action="{{route('admin.pages.about.image.offer')}}" method="POST" id="formImageOffer">
                            @method('PUT')
                            @csrf
                            <div class="form-inline">
                                <input class="form-control" type="file" name="imageOffer" onchange="document.getElementById('previewOption').src = window.URL.createObjectURL(this.files[0])">                                            
                                <button type="submit" class="btn btn-primary ml-3">Seçim Şəkli Yerləşdir</button>
                            </div>  
                            <span class="text-danger error-text imageOffer_error"></span>                                                    
                        </form>
                        <img id="previewMission" alt="logo" width="100" class="mt-4 mr-3" src="{{asset('front/')}}/img/icons/image_default.png" />

                        <img id="previewOption" alt="favicon" width="100" class="mt-4" src="{{asset('front/')}}/img/icons/image_default.png" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">Bizi seçin</h3>
                    </div>
                        <!-- /.card-header -->

                    <!-- form start -->
                    <form autocomplete="off" action="{{route('admin.pages.about.offer')}}" method="POST">
                        @csrf
                        <div class="card-body"> 
                            <div class="form-group">
                                <label for="exampleOffer">Təklif</label>
                                <input type="text" class="form-control @error('exampleOffer') is-invalid @enderror" id="exampleOffer" placeholder="Təklifin adını daxil edin" name="exampleOffer" value="{{old('exampleOffer')}}">
                                <span class="text-danger">@error('exampleOffer') {{$message}} @enderror</span>
                            </div>                           
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Təklif Yarat</button>
                        </div>
                    </form>                                
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                        <table id="exampleDataTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Təkliflər</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataOffers as $dataOffer)
                                <tr>
                                    <td>{{$dataOffer->data_value}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.pages.about.offer.delete', $dataOffer->data_id)}}" title="Sil" class="btn btn-danger mr-1"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
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

<script>
    $(function(){
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

        $("#formImageMission").on('submit', function(e){
                e.preventDefault();
          
                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        } else{
                            // $('#formSocialCompany')[0].reset();
                            toastr.success(data.msg, data.state);
                        }
                    }
                });
            });

            $("#formImageOffer").on('submit', function(e){
                e.preventDefault();
          
                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        } else{
                            // $('#formSocialCompany')[0].reset();
                            toastr.success(data.msg, data.state);
                        }
                    }
                });
            });
    })
</script>
@endsection