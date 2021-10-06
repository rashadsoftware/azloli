@extends('profile.layouts.master')

@section('title')
	{{$checkAdvert->advert_title}}
@section

@section('css')
	.ulDetail i{
		font-size:31px;
		color:var(--main-color)
	}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('profile.dashboard')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
<li class="breadcrumb-item"><a href="{{route('profile.adverts')}}"><i class="fa fa-list-ol"></i> Elanlar</a></li>
@endsection

@section('content')    
    <div class="position-relative">
		<h4>{{$checkAdvert->advert_title}}</h4>
		<p>{{$checkAdvert->advert_description}}</p>
		<p>Yayınlanma tarixi: {{$checkAdvert->CREATED_AT}}</p>		
	</div>		
	<a href="#" class="btn btn-primary mb-1">Təklifləri Göstər</a>
	<a href="{{route('profile.adverts.update', $checkAdvert->advert_id)}}" class="btn btn-success mb-1">Elanı Yenilə</a>
	<a href="{{route('profile.adverts.delete', $checkAdvert->advert_id)}}" class="btn btn-danger mb-1">Elanı Sil</a>
	<table class="table ulDetail">
		<tbody>
			<tr>
				<td>
					<i class="fa fa-pencil"></i>
				</td>
				<td>
					<p class="mb-0">Göndərən</p>
					<p class="mb-0">{{$checkAdvert->advert_user}}</p>
				</td>
			</tr>
			<tr>
				<td>
					<i class="fa fa-pencil"></i>
				</td>
				<td>
					<p class="mb-0">Elan Tarixi</p>
					<p class="mb-0">{{$checkAdvert->CREATED_AT}}</p>
				</td>
			</tr>
			<tr>
				<td>
					<i class="fa fa-pencil"></i>
				</td>
				<td>
					<p class="mb-0">İşə başlama tarixi</p>
					<p class="mb-0">{{$checkAdvert->advert_beginwork}}</p>
				</td>
			</tr>
			<tr>
				<td>
					<i class="fa fa-pencil"></i>
				</td>
				<td>
					<p class="mb-0">Ləvazimatlar</p>
					<p class="mb-0">{{$checkAdvert->advert_accessory}}</p>
				</td>
			</tr>
			<tr>
				<td>
					<i class="fa fa-pencil"></i>
				</td>
				<td>
					<p class="mb-0">Elan verənin ünvanı</p>
					<p class="mb-0">{{$checkAdvert->advert_address}}</p>
				</td>
			</tr>
		</tbody>
	</table>
	@if($checkAdvert->state == 'waiting')
		<div class="d-block btn btn-info">Təsdiq Gözləyir</div>	
	@endif
@endsection