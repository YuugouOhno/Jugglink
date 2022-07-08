@extends('layouts.app')　

@section('title')
    @yield('title')　　　　　　　　  　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
@endsection

@section('header')
    @yield('header')　　　　　　　　  　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
@endsection

@section('content')
    <div class='menues_container'>
        <div class='menues'>
            <div class='menue btnBox'>
                <a class="serch" href="{{ route("search.technique") }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>
            <div class='menue btnBox'>
                <image class='menue_image' src=''></image>
                <a href='{{ route("home")}}' class='menue_type'>ホーム</a>
            </div>
            <div class='menue btnBox'>
                <image class='menue_image' src=''></image>
                <a href='{{ route("profile.posts", ["user" => (Auth::user()->id)]) }}' class='menue_type'>プロフィール</a>
            </div>
            <div class='menue btnBox'>
                <image class='menue_image' src=''></image>
                <a href='{{ route("bookmarks.show", ["user" => (Auth::user()->id)]) }}' class='menue_type'>ブックマーク</a>
            </div>
            <div class='menue btnBox'>
                <image class='menue_image' src=''></image>
                <a href='{{ route("map")}}' class='menue_type'>ジャグラー分布</a>
            </div>
        </div>
        <div class='create_post btnBox'>
            <p><a href='{{ route("posts.create.index")}}'>投稿する</a></p>
        </div>
    </div>
    @yield('main')
@endsection

@section('script')
    @yield('script')
@endsection
