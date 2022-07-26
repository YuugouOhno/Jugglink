@extends('users.profile')

@section('title3')
    投稿/
@endsection

@section('header3')
    投稿/
@endsection

@section('main3')
    <div>
        <infinityposts-component :user_id="{{ json_encode($user->id)}}"></infinityposts-component>
    </div>
@endsection