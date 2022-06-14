@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="css/index.css">
    <title>profile</title>
@endsection

@section('main')
    <div>
        <image src='{{$user->icon}}'></image>
        <p class='name'>{{$user->name}}</p>
        <p class='tool'>道具{{$user->tool->name}}</p>
        <p class='start_date'>ジャグリング歴</p>
        <?php
        date_default_timezone_set('Asia/Tokyo');
        $today = new DateTime('now');
        $diff = {{$user->start_date}}->diff($today);
        echo $diff->days;
        ?>
        <p class='introduce'>{{$user->introduce}}</p>
    </div>
    <div>
        <a href="" class='following'>フォロー{{}}</a>
        <a href="" class='followed'>フォロワー{{}}</a>
    </div>
    <div>
        <a href="/user" class='own_posts'>投稿</a>
        <a href="" class='calendar'>カレンダー</a>
        <a href="/favo" class='favorite'>いいね</a>
    </div>
    @yield('profile_menue')
@endsection