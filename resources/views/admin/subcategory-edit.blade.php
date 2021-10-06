@extends('admin.layouts.master')

@section('title', 'Alt Kateqoriya Yenilə')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{route('admin.subcategory')}}">
    Alt Kateqoriyalar
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
                                    <h3 class="card-title text-capitalize">Alt Kateqoriya Yeniləmə</h3>
                                </div>
                                 <!-- /.card-header -->

                                <!-- form start -->
                                <form autocomplete="off" action="{{route('admin.subcategory.update', $subcategory->subcategory_id)}}" method="POST">
                                    @method('PUT')    
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="exampleCategory">Kateqoriya adı</label>
                                            <select class="form-control @error('exampleCategory') is-invalid @enderror" name="exampleCategory" id="exampleCategory">
                                                <option value="">Kateqoriya seçin</option>
                                                @foreach($categories as $category)
                                                <option 
													value="{{$category->category_id}}"
													@if($category->category_id==$subcategory->categoryID) selected @endif
                                                    >
													{{$category->category_title}}
												</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('exampleCategory') {{$message}} @enderror</span>
                                        </div>   
                                        <div class="form-group">
                                            <label for="exampleSubCategory">Alt kateqoriyanın adı</label>
                                            <input type="text" class="form-control @error('exampleSubCategory') is-invalid @enderror" id="exampleSubCategory" placeholder="Alt kateqoriyanın adını daxil edin" name="exampleSubCategory" value="{{$subcategory->subcategory_title}}">
                                            <span class="text-danger">@error('exampleSubCategory') {{$message}} @enderror</span>
                                        </div>                                                                           
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Rayon Yenilə</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
@endsection