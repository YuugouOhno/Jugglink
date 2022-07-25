@extends('layouts.app')　

@section('title1')
    @yield('title2')
@endsection

@section('header1')
<div style="display:flex">
    <menuemodal-component></menuemodal-component>
    <div class="display_title">
    @yield('header2')
    </div>
</div>
@endsection

@section('main1')
    <!--<div id="menues_container" class='menues_container BG_color_white'>-->
    <!--    <div class='menues'>-->
    <!--        <div class='menue btnBox'>-->
    <!--            <a class='color_black' href="{{ route("home") }}">-->
    <!--                Jugglink-->
    <!--            </a>-->
    <!--        </div>-->
    <!--        <div class='menue btnBox'>-->
    <!--            <a class='color_black' href='{{ route("home")}}'>-->
    <!--                <i class="fa-solid fa-house-chimney"></i>-->
    <!--                <p class="menue_text">ホーム</p>-->
    <!--            </a>-->
    <!--        </div>-->
    <!--        <div class='menue btnBox'>-->
    <!--            <a class="color_black serch" href="{{ route("search.technique") }}">-->
    <!--                <i class="fa-solid fa-magnifying-glass"></i><p class="menue_text">検索</p>-->
    <!--            </a>-->
    <!--        </div>-->
    <!--        <div class='menue btnBox'>-->
    <!--            <a class='color_black' href='{{ route("profile.posts", ["user" => (Auth::user()->id)]) }}'>-->
    <!--                <i class="fa-solid fa-address-card"></i><p class="menue_text">プロフィール</p>-->
    <!--            </a>-->
    <!--        </div>-->
    <!--        <div class='menue btnBox'>-->
    <!--            <a class='color_black' href='{{ route("bookmarks.show", ["user" => (Auth::user()->id)]) }}'>-->
    <!--                <i class="fa-solid fa-bookmark"></i><p class="menue_text">ブックマーク</p>-->
    <!--            </a>-->
    <!--        </div>-->
    <!--        <div class='menue btnBox'>-->
    <!--            <a class='color_black' href='{{ route("map")}}'>-->
    <!--                <i class="fa-solid fa-map-location-dot"></i><p class="menue_text">ジャグラー分布</p>-->
    <!--            </a>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class='create_post btnBox'>-->
    <!--        <div class='modaldada'>-->
    <!--            <postmodal-component></postmodal-component>-->
    <!--        </div>-->
    <!--        <a class='color_black' href='{{ route("posts.create.index")}}'>-->
    <!--            投稿する-->
    <!--        </a>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="menues_container border_color_purple"></div>
    <div id="main_container" class='main_container BG_color_white'>
    @yield('main2')
    </div>
    <div class='right_container BG_color_white'></div>
@endsection

@section('script1')
    @yield('script2')
@endsection
