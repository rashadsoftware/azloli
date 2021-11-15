@extends('admin.layouts.master')

@section('title', 'Kateqoriya Yarat')

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
                                    <h3 class="card-title text-capitalize">Yeni Kateqoriya</h3>
                                </div>
                                 <!-- /.card-header -->

                                <!-- form start -->
                                <form enctype="multipart/form-data" autocomplete="off" action="{{route('admin.category.insert')}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleCategory">Kateqoriya adı</label>
                                            <input type="text" class="form-control @error('exampleCategory') is-invalid @enderror" id="exampleCategory" placeholder="Kateqoriyanın adını daxil edin" name="exampleCategory" value="{{old('exampleCategory')}}">
                                            <span class="text-danger">@error('exampleCategory') {{$message}} @enderror</span>
                                        </div>  
                                        <!--
                                            <div class="form-group">
                                                <label for="exampleCategoryImage">Kateqoriya şəkli</label>
                                                <input class="form-control" type="file" id="exampleCategoryImage" name="exampleCategoryImage" onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])"> 
                                                <span class="text-danger">@error('exampleCategoryImage') {{$message}} @enderror</span>
                                            </div>       
                                            <img id="previewImage" alt="image" width="100" class="mt-4" src="{{asset('back/')}}/img/icons/image_path.png" />
                                        -->                               
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Kateqoriya Yarat</button>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
@endsection