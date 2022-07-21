@extends('others.menue')

@section('title2')
    <title>ホーム/Jugglink</title>
    <link href="{{secure_asset('css/postmodal.css')}}" rel="stylesheet">
@endsection

@section('header2')
    <h4>ホーム</h4>
@endsection

@section('main2')
    <div class='modaldada'>
        <postmodal-component></postmodal-component>
    </div>
    <div class='posts_container'>
        <posts-component :url="{{ json_encode('/infinity_posts/')}}" :id="{{ json_encode(0)}}"></posts-component>
    </div>
@endsection