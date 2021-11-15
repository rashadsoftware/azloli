@extends('admin.layouts.master')

@section('title', 'Kateqoriya Yenilə')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{route('admin.category')}}">
        Kateqoriyalar
    </a>
</li>
@endsection

@section('content')
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-7 col-xl-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title text-capitalize">Kateqoriya Yeniləmə</h3>
                                </div>
                                 <!-- /.card-header -->

                                <!-- form start -->
                                <form enctype="multipart/form-data" autocomplete="off" action="{{route('admin.category.update', $category->category_id)}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleCategory">Kateqoriya adı</label>
                                            <input type="text" class="form-control @error('exampleCategory') is-invalid @enderror" id="exampleCategory" placeholder="Kateqoriyanın adını daxil edin" name="exampleCategory" value="{{$category->category_title}}">
                                            <span class="text-danger">@error('exampleCategory') {{$message}} @enderror</span>
                                        </div>   
                                        <!--
                                            <div class="form-group">
                                                <label for="exampleCategoryImage">Kateqoriya şəkli</label>
                                                <input class="form-control" type="file" id="exampleCategoryImage" name="exampleCategoryImage" onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])"> 
                                                <span class="text-danger">@error('exampleCategoryImage') {{$message}} @enderror</span>
                                            </div>  
                                            @if($category->category_image == '')
                                                <img id="previewImage" alt="{{$category->category_seftitle}}" width="100" src="{{asset('back/')}}/img/icons/image_path.png" class="mt-4" />
                                            @else
                                                <img id="previewImage" alt="{{$category->category_seftitle}}" width="100" src="{{asset('front/')}}/img/categories/{{$category->category_image}}" class="mt-4" />
                                            @endif
                                        -->
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Kateqoriya Yenilə</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
@endsection