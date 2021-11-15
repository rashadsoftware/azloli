@extends('admin.layouts.master')

@section('title', 'Təkliflər')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{route('admin.pages.about')}}">
        Haqqımızda
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
                        <h3 class="card-title text-capitalize">Bizi seçin</h3>
                    </div>
                        <!-- /.card-header -->

                    <!-- form start -->
                    <form autocomplete="off" action="{{route('admin.pages.about.offer.update')}}" method="POST">
                        @method('PUT') 
                        @csrf
                        <div class="card-body"> 
                            <div class="form-group">
                                <label for="exampleOffer">Təklifi Yenilə</label>
                                <input type="text" class="form-control @error('exampleOffer') is-invalid @enderror" id="exampleOffer" placeholder="Təklifin adını daxil edin" name="exampleOffer" value="{{$dataOffer->data_value}}">
                                <span class="text-danger">@error('exampleOffer') {{$message}} @enderror</span>
                                <input type="hidden" name="hiddenID" value="{{$dataOffer->data_id}}">
                            </div>                           
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Təklifi Yenilə</button>
                        </div>
                    </form>                                
                </div>              
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection