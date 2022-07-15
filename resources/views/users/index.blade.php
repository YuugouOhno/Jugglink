@extends('users.profile')

@section('title3')
    投稿/
@endsection

@section('header3')
    投稿/
@endsection

@section('main3')
    <div>
        <posts-component :url="{{ json_encode('/infinity_users/')}}" :id='{{ json_encode($user->id)}}'></posts-component>
    </div>
@endsection