<div class="card box-shadow mx-auto" style="width:333px">
    <div class="card-body">
        @if($user->user_image == '')
            <img src="{{asset('front/')}}/img/user/profile.png" alt="{{$user->user_name}}" class="profile-img">
        @else
            <img src="{{asset('front/')}}/img/user/{{$user->user_image}}" alt="{{$user->user_name}}" class="profile-img">
        @endif
        <h4 class="profile-title">{{$user->user_name}}</h4>
        <ul class="profile-list mt-4">
            <li class="{{ Route::is('profile.dashboard') ? 'active' : '' }}">	
                <a href="{{route('profile.dashboard')}}">
                    <div>
                        <i class="fa fa-home"></i> Ana səhifə
                    </div>
                    <i class="fa fa-arrow-right"  style="font-size:16px"></i>
                </a>                                
            </li>
            <li class="{{ Route::is('profile.settings') ? 'active' : '' }}">	
                <a href="{{route('profile.settings')}}">
                    <div>
                        <i class="fa fa-cogs"></i> Tənzimləmələr
                    </div>
                    <i class="fa fa-arrow-right"  style="font-size:16px"></i>
                </a>
            </li>
        </ul>
        <a href="{{route('profile.logout')}}" class="btn uza-btn btn-2 mt-3 w-100">Çıxış</a>
    </div>
</div>