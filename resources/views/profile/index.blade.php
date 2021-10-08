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
        <div class="col-7">
            <table class="table">    
                <tbody>
                    <tr>
                        <th scope="row">Adı Soyadı</th>
                        <td>{{$user->user_name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">E-poçt</th>
                        <td>{{$user->user_email}}</td>
                    </tr>
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