@extends('admin.layouts.master')

@section('title', 'Alt Kateqoriyalar')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Bootstrap Toggle -->
<link rel="stylesheet" href="{{asset('back/')}}/plugins/bootstrap-toggle/bootstrap-toggle.min.css">
@endsection

@section('content')
    @if($categoriesCount > 0)
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mb-3">
                        <a href="{{route('admin.subcategory.create')}}" class="btn btn-success text-capitalize"><i class="fas fa-plus"></i>&nbsp Alt kateqoriya yarat</a>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Alt Kateqoriyaların Siyahısı</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="exampleDataTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:10%">ID</th>                                                
                                            <th class="font-weight-bold">Kateqoriyanın adı</th>
                                            <th>Alt kateqoriyanın adı</th>
                                            <th>Status</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subcategories as $subcategory)
                                        <tr>
                                            <td class="text-center">{{$subcategory->subcategory_id}}</td>
                                            <td>{{$subcategory->getCategory->category_title}}</td>
                                            <td>{{$subcategory->subcategory_title}}</td>     
                                            <td class="text-center"> 
                                                <input type="checkbox" data-id="{{$subcategory->subcategory_id}}" data-toggle="toggle" data-off="Passiv" data-on="Aktiv" class="toggleSubCategory" data-size="normal" @if($subcategory->subcategory_state == 'active') ? checked : '' @endif>
                                            </td>                                            
                                            <td class="text-center">
                                                <a href="{{route('admin.subcategory.edit', $subcategory->subcategory_id)}}" title="Yenilə" class="btn btn-primary mr-1"><i class="fas fa-pen"></i></a>
                                                <a href="{{route('admin.subcategory.delete', $subcategory->subcategory_id)}}" title="Sil" class="btn btn-danger mr-1"><i class="fas fa-trash-alt"></i></a>           
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
                        <p>Bu sahənin aktiv olması üçün məlumatlar bazasına kateqoriya daxil edilməlidir.</p>
                    </div>                  
                </div>
            </div>
        </section>
        <!-- /.content -->
    @endif
@endsection
@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('back/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<!-- Bootstrap Switch -->
<script src="{{asset('back/')}}/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>

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

        // bootstrap toggle event
        $(".toggleSubCategory").on('change', function(){
            var getID=$(this).attr('data-id');
            var getStatus=$(this).prop('checked');

            $.get("{{route('admin.subcategory.toggle')}}", {getID:getID, getStatus:getStatus} , function(data, status){
                console.log(data);
            });
        });
    })
</script>
@endsection