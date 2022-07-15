@extends('users.profile')

@section('title3')
    いいね/
@endsection

@section('header3')
    いいね/
@endsection

@section('main3')
    <div>
        <posts-component :url="{{ json_encode('/infinity_likes/')}}" :id='{{ json_encode($user->id)}}'></posts-component>
    </div>
@endsection