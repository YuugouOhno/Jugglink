@extends('users.profile')

@section('title2')
    <title>ブックマーク/Jugglink</title>
@endsection

@section('header2')
    <h4>ブックマーク</h4>
@endsection

@section('main2')
    <div>
        <posts-component :url="{{ json_encode('/infinity_bookmarks/')}}" :id='{{ json_encode($user->id)}}'></posts-component>
    </div>
@endsection