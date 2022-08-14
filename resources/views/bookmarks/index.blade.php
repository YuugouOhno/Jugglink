@extends('users.profile')

@section('title2')
    <title>ブックマーク/Jugglink</title>
@endsection

@section('header2')
    <h4>ブックマーク</h4>
@endsection

@section('main2')
    <div>
        <infinityposts-component :bookmark_id='{{ json_encode($user->id)}}'></infinityposts-component>
    </div>
@endsection