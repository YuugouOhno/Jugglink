@extends('users.profile')

@section('title3')
    いいね/
@endsection

@section('header3')
    いいね/
@endsection

@section('main3')
    <div>
        <infinityposts-component :like_id='{{ json_encode($user->id)}}'></infinityposts-component>
    </div>
@endsection