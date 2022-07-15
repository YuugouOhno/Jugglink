@extends('others.menue')

@section('title2')
    <title>ホーム/Jugglink</title>
@endsection

@section('header2')
    <h4>無限</h4>
@endsection

@section('main2')
    <div class='posts_container'>
        <posts-component :url="{{ json_encode('/infinity_posts/')}}" :id="{{ json_encode(0)}}"></posts-component>
    </div>
@endsection