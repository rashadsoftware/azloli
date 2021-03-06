@extends('admin.layouts.master')

@section('title', 'Banner')

@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">Banner</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form autocomplete="off" action="{{route('admin.pages.banner.post')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="card-body"> 
                            <div class="form-group">
                                <label for="exampleBannerTitle">Banner başlığı</label>
                                <input type="text" class="form-control @error('exampleBannerTitle') is-invalid @enderror" id="exampleBannerTitle" placeholder="Banner başlığı daxil edin" name="exampleBannerTitle" value="{{old('exampleBannerTitle')}}">
                                <span class="text-danger">@error('exampleBannerTitle') {{$message}} @enderror</span>
                            </div>  
                            <div class="form-group">
                                <label for="exampleBannerSubTitle">Banner alt başlığı</label>
                                <textarea name="exampleBannerSubTitle" cols="30" rows="10" placeholder="Banner alt başlığı daxil edin" class="form-control" id="summernote"></textarea>
                                <span class="text-danger">@error('exampleBannerSubTitle') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label>Select</label>
                                <select class="form-control" name="examplePosition">
                                    <option value="">Pozisyon seçin</option>
                                    <option value="right">Sağ tərəf</option>
                                    <option value="left">Sol tərəf</option>
                                </select>
                                <span class="text-danger">@error('examplePosition') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleBannerImage">Banner Şəkli</label>
                                <input class="form-control" type="file" name="exampleBannerImage" onchange="document.getElementById('previewBanner').src = window.URL.createObjectURL(this.files[0])
                                ">            
                                <span class="text-danger">@error('exampleBannerImage') {{$message}} @enderror</span>                                
                            </div>   
                              
                            <img id="previewBanner" alt="image" width="100" class="mt-4 mr-3" src="{{asset('front/')}}/img/icons/image_default.png" />              
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Banner Yarat</button>
                        </div>
                    </form>                                
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-body">
                        <table id="exampleDataTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Şəkillər</th>
                                    <th>Başlıq</th>
                                    <th>Əməliyyat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataBanners as $dataBanner)
                                <tr>
                                    <td><img id="previewBanner" alt="image" width="100" src="{{asset('front/')}}/img/banner/{{$dataBanner->banner_image}}" /></td>
                                    <td>{{$dataBanner->banner_title}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.pages.banner.update', $dataBanner->banner_id)}}" title="Yenile" class="btn btn-primary mr-1"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{route('admin.pages.banner.delete', $dataBanner->banner_id)}}" title="Sil" class="btn btn-danger mr-1"><i class="fas fa-trash-alt"></i></a>
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
<!-- summernote -->
<script src="{{asset('back/')}}/plugins/summernote/summernote-bs4.min.js"></script>

    <script>
        $(function(){
            // Summernote
            $('#summernote').summernote();
        });
    </script>
@endsection