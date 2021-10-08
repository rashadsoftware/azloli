@extends('profile.layouts.master')

@section('title', 'Bacarıqlar')

@section('css')
	<style>
		.times-icon{		
			position:absolute;
			top:7px;
			right:10px;
			cursor:pointer;
			z-index:10
		}
	</style>
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('profile.dashboard')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
@endsection

@section('content')   
	@if($message=Session::get('successSkills'))
	<div class="w-100 mt-1">
		<div class="alert alert-success">
			{{ $message }}
		</div>
	</div>
	@endif

	@if($message=Session::get('errorSkills'))
	<div class="w-100 mt-1">
		<div class="alert alert-danger">
			{{ $message }}
		</div>
	</div>
	@endif 
    <form action="{{route('profile.skills.add')}}" method="POST" class="mt-4" autocomplete="off">
		@csrf
		<div class="form-inline">
			<select class="form-control @error('selectSkills') is-invalid @enderror w-50" name="selectSkills">
				<option value="">Bacarıq seçin</option>
				@foreach($subcategories as $subcategory)
				<option 
					value="{{$subcategory->subcategory_id}}" 
					{{old('selectSkills') == $subcategory->subcategory_id ? 'selected' : ''}}
				>
					{{$subcategory->subcategory_title}}
				</option>
				@endforeach
			</select>                                            
			<button type="submit" class="btn btn-primary ml-3">Bacarıq Əlavə Et</button>
		</div>  
		<span class="text-danger">@error('selectSkills') {{$message}} @enderror</span>
	</form>
	
	<hr>
	
	<div class="container-fluid mt-4">
		<div class="row">
			@if($skillsCount > 0)
				@foreach($skills as $skill)
				<div class="col-6 col-md-4 col-lg-3">
					<div class="position-relative w-100 p-2 mb-2 bg-primary text-white" style="border-radius:4px">
						<span>{{$skill->getSubCategory->subcategory_title}}</span>
						<a href="{{route('profile.skills.delete', $skill->skill_id)}}" class="times-icon text-white"><i class="fa fa-times"></i></a>
					</div>
				</div>
				@endforeach
			@else
				<p class="mt-4">Bu istifadəçiyə dair heç bir bacarıq yayınlanmamışdır.</p>
			@endif			
		</div>
	</div>
@endsection