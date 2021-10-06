@extends('admin.layouts.master')

@section('title', 'Alt Kateqoriya Yarat')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{route('admin.subcategory')}}">
    Alt Kateqoriyalar
    </a>
</li>
@endsection

@section('content')
    @if($categoriesCount > 0)
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-7 col-xl-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title text-capitalize">Yeni Alt Kateqoriya</h3>
                            </div>
                                <!-- /.card-header -->

                            <!-- form start -->
                            <form autocomplete="off" action="{{route('admin.subcategory.insert')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="exampleCategory">Kateqoriya adı</label>
                                        <select class="form-control @error('exampleCategory') is-invalid @enderror" name="exampleCategory" id="exampleCategory">
                                            <option value="">Kateqoriya seçin</option>
                                            @foreach($categories as $category)
                                            <option 
                                                value="{{$category->category_id}}" 
                                                {{old('exampleCategory') == $category->category_id ? 'selected' : ''}}
                                            >
                                                {{$category->category_title}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('exampleCategory') {{$message}} @enderror</span>
                                    </div>   
                                    <div class="form-group">
                                        <label for="exampleSubCategory">Alt Kateqoriya adı</label>
                                        <input type="text" class="form-control @error('exampleSubCategory') is-invalid @enderror" id="exampleSubCategory" placeholder="Alt kateqoriyanın adını daxil edin" name="exampleSubCategory" value="{{old('exampleSubCategory')}}">
                                        <span class="text-danger">@error('exampleSubCategory') {{$message}} @enderror</span>
                                    </div>                                                                           
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Alt Kateqoriya Yarat</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    @else    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="callout callout-danger">
                        <h5>Vacib Bildiriş!</h5>
                        <p>Bu sahənin aktiv olması üçün məlumatlar bazasına şəhər daxil edilməlidir.</p>
                    </div>                  
                </div>
            </div>
        </section>
        <!-- /.content -->
    @endif
@endsection