@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>profile</title>
@endsection

@section('main')
    <div>
        {{--<image src='{{$user->icon}}'></image>--}}
        <p class='icon'>{{$user->icon}}</p>
        <p class='name'>{{$user->name}}</p>
        <p class='tool'>道具{{$user->tool->name}}</p>
        <p class='start_date'>ジャグリング歴{{$user->start_date}}</p>
        <p class='introduce'>{{$user->introduction}}</p>
    </div>
    <div>
        <a href="" class='following'>フォロー</a>
        <a href="" class='followed'>フォロワー</a>
    </div>
    <div>
        <a href="/user" class='own_posts'>投稿</a>
        <a href="" class='calendar'>カレンダー</a>
        <a href="/favo" class='favorite'>いいね</a>
    </div>
    @yield('profile_menue')
@endsection

@section('script')
    @yield('script')
@endsection