@extends('profile.layouts.master')

@section('title', 'İş Təklifləri')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{route('profile.dashboard')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
@endsection

@section('content') 
	<div class="container-fluid">
		<div class="row" style="max-height:448px; overflow-y:auto">
			@if($user->user_publish == 'publish')
				@if($allChecks->count() > 0)				
					@foreach($unreadChecks as $advertItem)
						<div class="col-12 mb-2">
							<a href="{{route('profile.advert.detail', $advertItem->getAdvert->advert_id)}}">
								<div class="card">
									<div class="card-body" style="padding:0.5rem">
										<div class="d-flex align-items-center justify-content-between">
											<div>
												<h4 class="mb-0">{{$advertItem->getAdvert->advert_title}}</h4>
												<span class="text-muted mb-0">{{$advertItem->getAdvert->updated_at->format('Y-m-d')}}</span>
											</div>
											<img src="{{asset('public/front/')}}/img/icons/new.png" alt="new" width="50">
										</div>						
									</div>
								</div>
							</a>					
						</div>
					@endforeach
					
					@foreach($readChecks as $advertItemRead)
						<div class="col-12 mb-2">
							<a href="{{route('profile.advert.detail', $advertItemRead->getAdvert->advert_id)}}">
								<div class="card">
									<div class="card-body" style="padding:0.5rem">
										<div class="d-flex align-items-center justify-content-between">
											<div>
												<h4 class="mb-0">{{$advertItemRead->getAdvert->advert_title}}</h4>
												<span class="text-muted mb-0">{{$advertItemRead->getAdvert->updated_at->format('Y-m-d')}}</span>
											</div>
										</div>						
									</div>
								</div>
							</a>					
						</div>
					@endforeach
				@else
					<div class="col-12">
						<div class="alert alert-info">Paylaşılmış yeni bir iş təklifi yoxdur</div>
					</div>
				@endif
			@else
				<div class="col-12">
					<div class="alert alert-info">Yeni iş təkliflərini görmək üçün siz profilinizi aktivləşdirməlisiniz</div>
				</div>
			@endif
		</div>
	</div>
@endsection