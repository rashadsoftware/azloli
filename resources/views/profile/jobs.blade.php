@extends('profile.layouts.master')

@section('title', 'İşlər')

@section('css')
<style>
	.times-icon{		
		position:absolute;
		top:1px;
		right:7px;
		cursor:pointer;
		z-index:10
	}
</style>
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('profile.dashboard')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
@endsection

@section('content')    
	@if($message=Session::get('successJobs'))
	<div class="w-100 mt-1">
		<div class="alert alert-success">
			{{ $message }}
		</div>
	</div>
	@endif

    <form action="{{route('profile.jobs.add')}}" method="POST" enctype="multipart/form-data" class="mt-4">
		@csrf
		<div class="form-inline">
			<input type="file" class="form-control @error('job_image') is-invalid @enderror" name="job_image" onchange="document.getElementById('previewJobs').src = window.URL.createObjectURL(this.files[0])">                                            
			<button type="submit" class="btn btn-primary ml-3">Şəkil Yerləşdir</button>
		</div>  
		<span class="text-danger">@error('job_image') {{$message}} @enderror</span>
	</form>
	<img id="previewJobs" alt="profile" width="100" height="100" class="mt-4" src="{{asset('front/')}}/img/icons/profile.svg" />
	
	<hr>
	
	<div class="container-fluid">
		<div class="row">
			@if($jobsCount > 0)
				@foreach($jobs as $job)
				<div class="col-6 col-md-4 col-lg-3">
					<a href="{{asset('front/')}}/img/jobs/{{$job->job_image}}" data-lightbox="roadtrip">
						<div class="position-relative mb-2" style="border:1px solid #ccc">
							<img alt="jobs" width="100" src="{{asset('front/')}}/img/jobs/{{$job->job_image}}" class="p-2" />
							<a href="{{route('profile.jobs.delete', $job->job_id)}}" class="times-icon"><i class="fa fa-times"></i></a>
						</div>
					</a>
				</div>
				@endforeach
			@else
				<p class="mt-4">Heç bir referans iş paylaşılmamışdır.</p>
			@endif			
		</div>
	</div>
@endsection