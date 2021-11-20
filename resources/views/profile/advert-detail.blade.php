@extends('profile.layouts.master')

@section('title', 'İş Təklifləri')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('profile.dashboard')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
	<li class="breadcrumb-item"><a href="{{route('profile.advert')}}"> İş Təklifləri</a></li>
@endsection

@section('content') 
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body" style="padding:0.9rem">
						<h3>{{$getAdvert->advert_title}}</h3>

						@php $getAdvertChecks=DB::table('checks')->where('advertID', $getAdvert->advert_id)->where('userID', $idUser)->first() @endphp
						@if($getAdvertChecks->check_status != 'confirm')
						<a href="{{route('profile.advert.confirm', $getAdvert->advert_id)}}" class="btn btn-success mb-1"><i class="fas fa-check mr-1"></i> Təsdiqlə</a>
						@endif
						
						<hr>
						
						<p class="mt-3 text-dark">{{$getAdvert->advert_description}}</p>
						
						<p class="mb-0"><span>İstifadəçi: {{$getAdvert->advert_name}}</span></p>						
						<p class="mb-0"><span>#{{$getAdvert->getSubCategory->subcategory_title}}</span></p>						
					</div>
					<div class="card-footer">
						<a href="{{route('profile.advert')}}" class="btn btn-primary"><i class="fas fa-chevron-left mr-1"></i> Geri Qayıt</a>
					</div>
				</div>	
			</div>
		</div>
	</div>
@endsection