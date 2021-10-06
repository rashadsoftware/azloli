@extends('profile.layouts.master')

@section('title', 'Elanlar')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('profile.dashboard')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
@endsection

@section('content')    
    <div class="w-100 text-right mb-3"><a href="#" class="btn btn-success"><i class="fa fa-plus"> Xidmət Ver</i></a></div>
	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Aktiv</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Sonlanan</a>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<table class="table table-hover mt-4">
				<tbody>
					@if($advertsCompletedCount > 0)
					@foreach($advertsCompleted as $advertCompleted)
					<tr>
						<td>
							<a href="{{route('profile.adverts.detail', $advertCompleted->advert_seftitle)}}">
								<h5 class="mb-0">{{$advertCompleted->advert_title}}</h5>
								<p class="mb-0">{{$advertCompleted->advert_description}}</p>
								<p class="mb-0">Yayın tarixi: {{$advertCompleted->CREATED_AT}}</p>
							</a>
						</td>
						<td class="text-center">
							<a href="{{route('profile.adverts.update', $advertCompleted->advert_id)}}" title="Yenilə" class="btn btn-primary mr-1 mb-1"><i class="fa fa-pencil"></i></a>
							<a href="{{route('profile.adverts.delete', $advertCompleted->advert_id)}}" title="Sil" class="btn btn-danger mr-1 mb-1"><i class="fa fa-remove"></i></a>
						</td>
					</tr>
					@endforeach
					@else
						<p>Hal-hazırda aktiv heç bir elan paylaşılmamışdır.</p>
					@endif
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
			<table class="table table-hover mt-4">
				<tbody>
					@if($advertsUncompletedCount > 0)
					@foreach($advertsUncompleted as $advertUncompleted)
					<tr>
						<td>
							<a href="{{route('profile.adverts.detail', $advertUncompleted->advert_seftitle)}}">
								<h5 class="mb-0">{{$advertUncompleted->advert_title}}</h5>
								<p class="mb-0">{{$advertUncompleted->advert_description}}</p>
								<p class="mb-0">Yayın tarixi: {{$advertUncompleted->CREATED_AT}}</p>
							</a>
						</td>
						<td class="text-center">
							<a href="{{route('profile.adverts.delete', $advertUncompleted->advert_id)}}" title="Sil" class="btn btn-danger mr-1 mb-1"><i class="fa fa-remove"></i></a>
						</td>
					</tr>
					@endforeach
					@else
						<p>Hal-hazırda passif heç bir elan paylaşılmamışdır.</p>
					@endif
				</tbody>
			</table>
		</div>
	</div>
@endsection