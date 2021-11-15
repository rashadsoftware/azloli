@extends('admin.layouts.master')

@section('title', 'Banner Yeniləmə')

@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{route('admin.pages.banner')}}">
        Banner
    </a>
</li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">Banner Yenilə</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form autocomplete="off" action="{{route('admin.pages.banner.update.post', $dataBanners->banner_id)}}" method="POST"  enctype="multipart/form-data">
                        @method('PUT') 
                        @csrf
                        <div class="card-body"> 
                            <div class="form-group">
                                <label for="exampleBannerTitle">Banner başlığı</label>
                                <input type="text" class="form-control @error('exampleBannerTitle') is-invalid @enderror" id="exampleBannerTitle" placeholder="Banner başlığı daxil edin" name="exampleBannerTitle" value="{{ $dataBanners->banner_title }}">
                                <span class="text-danger">@error('exampleBannerTitle') {{$message}} @enderror</span>
                            </div>  
                            <div class="form-group">
                                <label for="exampleBannerSubTitle">Banner alt başlığı</label>
                                <textarea name="exampleBannerSubTitle" cols="30" rows="10" placeholder="Banner alt başlığı daxil edin" class="form-control" id="summernote">{{ $dataBanners->banner_subtitle }}</textarea>
                                <span class="text-danger">@error('exampleBannerSubTitle') {{$message}} @enderror</span>
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
                            <button type="submit" class="btn btn-primary float-right">Banner Yenilə</button>
                        </div>
                    </form>                                
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