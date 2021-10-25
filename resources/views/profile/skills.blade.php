@extends('profile.layouts.master')

@section('title', 'Bacarıqlar')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('profile.dashboard')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
@endsection

@section('content')   
	@if($message=Session::get('successSkills'))
	<div class="w-100 mt-1 j_Alert">
		<div class="alert alert-success">
			{{ $message }}
		</div>
	</div>
	@endif

	@if($message=Session::get('errorSkills'))
	<div class="w-100 mt-1 j_Alert">
		<div class="alert alert-danger">
			{{ $message }}
		</div>
	</div>
	@endif 
	<div class="col-6">
		<form action="{{route('profile.skills.add')}}" method="POST" class="mt-4" autocomplete="off">
			@csrf
			<div class="form-group">
				<select class="form-control @error('selectCategory') is-invalid @enderror mr-2" name="selectCategory" id="selectCategory">
					<option value="">Kateqoriya seçin</option>
					@foreach($categories as $category)
					<option 
						value="{{$category->category_id}}" 
						{{old('selectCategory') == $category->category_id ? 'selected' : ''}}
					>
						{{$category->category_title}}
					</option>
					@endforeach
				</select>  
				<span class="text-danger">@error('selectCategory') {{$message}} @enderror</span>
			</div> 
			<div class="form-group">  
				<select class="form-control @error('selectSkills') is-invalid @enderror" name="selectSkills" id="selectSkills">
					<option value="">Bacarıq seçin</option>
				</select> 
				<span class="text-danger">@error('selectSkills') {{$message}} @enderror</span>
			</div> 
			<button type="submit" class="btn btn-primary">Bacarıq Əlavə Et</button> 
			
		</form>
	</div>   
	
	<hr>
	
	<div class="container-fluid mt-4">
		<div class="row d-flex">
			@if($skillsCount > 0)
				@foreach($skills as $skill)
				<div class="p-2 mb-2 bg-primary mr-2 text-white" style="border-radius:4px">
					<span class="mr-2">{{$skill->getSubCategory->subcategory_title}}</span>
					<a href="{{route('profile.skills.delete', $skill->skill_id)}}" class="text-white"><i class="fa fa-times"></i></a>
				</div>
				@endforeach
			@else
				<p class="mt-4">Bu istifadəçiyə dair heç bir bacarıq yayınlanmamışdır.</p>
			@endif			
		</div>
	</div>
@endsection

@section('js')
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $(function () {
        // dependent dropdown using AJAX
        $("#selectCategory").change(function (e) {
            e.preventDefault();
            var cateDropdown = document.getElementById("selectCategory").value;

            $.ajax({
                type: "POST",
                url: "skills/fetch",
                data: { cateID: cateDropdown },
                success: function (response) {
                    var districtDropdown = "";
                    var msg = response.content;

                    if (response.status == "success") {
                        $.each(msg, function (key, value) {
                            districtDropdown +=
                                "<option value='" +
                                key +
                                "' >" +
                                value +
                                "</option>";
                        });
                    } else {
                        districtDropdown += "<option value=''>" + msg + "</option>";
                    }

                    document.getElementById("selectSkills").innerHTML =
                        districtDropdown;
                },
            });
        });
    });
</script>
@endsection