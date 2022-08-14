@extends('layouts.app')　

@section('title1')
    <link href="{{secure_asset('css/post.css')}}" rel="stylesheet">
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
    <div class="menues_container border_color_purple"></div>
    <div id="main_container" class='main_container BG_color_white'>
    @yield('main2')
    </div>
    <div class='right_container BG_color_white'></div>
@endsection

@section('script1')
    @yield('script2')
@endsection
