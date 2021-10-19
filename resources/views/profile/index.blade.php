@extends('profile.layouts.master')

@section('title', 'Dashboard')

@section('css')
    <style>
        .table td, .table th{
            border-bottom:0
        }
    </style>
@endsection
@section('content')    
    <h5 class="text-capitalize">İstifadəçi Məlumatları</h5>
    <div class="row">
        <div class="col-12 col-md-7">
            <table class="table">    
                <tbody>
                    <tr>
                        <th scope="row">İstifadəçi</th>
                        <td>{{$user->user_name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">E-poçt</th>
                        <td>{{$user->user_email}}</td>
                    </tr>
                    @if($user->user_phone != '')
                    <tr>
                        <th scope="row">Telefon</th>
                        <td>{{$user->user_phone}}</td>
                    </tr>
                    @endif
                    <tr>
                        <th scope="row">Qeydiyyat tarixi</th>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y/m/d') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12 col-md-5">
            <table class="table">    
                <tbody>
                    <tr>
                        <th scope="row">Durumu</th>
                        <td>{{$user->user_state == 'active' ? 'Aktiv' : 'Aktiv Deyil'}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Statusu</th>
                        <td>{{$user->user_status == 'user' ? 'İstifadəçi' : 'Bilinmir'}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Yayınlanma</th>
                        <td>{{$user->user_publish == 'publish' ? 'Yayımdadır' : 'Yayımda Deyil'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>  
    @if($user->user_description != '') 
    <div class="row">
        <div class="col-12">
            <p class="mb-0">{{$user->user_description}}</p>
        </div>
    </div> 
    @endif
    
    <hr>
    <h5 class="text-capitalize">Referans işlər</h5>
    
    @if($imagesCount > 0)
    <div class="row">
        @foreach($images as $image)
        <div class="col-6 col-md-4 col-lg-3">
            <img src="{{asset('front/')}}/img/jobs/{{$image->job_image}}" alt="{{$user->user_name}}">
        </div>
        @endforeach
    </div>
    @else 
        <p class="mt-4">Bu istifadəçiyə dair heç bir iş paylaşılmamışdır.</p>
    @endif
    
    <hr>
    <h5 class="text-capitalize">İstifadəçinin bacarıqları</h5>
    @if($skillsCount > 0)
        @foreach($skills as $skill)
        <div class="p-2 mb-2 bg-primary text-white float-left mr-2" style="border-radius:4px">
            <span>{{$skill->getSubCategory->subcategory_title}}</span>
        </div>
        @endforeach
    @else
        <p class="mt-4">Bu istifadəçiyə dair heç bir bacarıq yayınlanmamışdır.</p>
    @endif    
@endsection