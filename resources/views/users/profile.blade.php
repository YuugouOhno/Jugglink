@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>profile</title>
@endsection

@section('main')
    <div class='posts_container'>
        <div>
            @if($user->icon_path !=0)
                <img  class='user_icon' src="{{ $user->icon_path }}">
            @else
                <i class="fa-solid fa-circle-user" style="font-size:50px;"></i>
            @endif
            <p class='user_name'>{{$user->name}}</p>
            @if($user->tool==0)
                <p class='tool'>道具:道具が未選択です</p>
            @else
                <p class='tool'>道具:{{$user->tool->tool_name}}</p>
            @endif
            @if($user->introduce==0)
                <p class='tool'>コメント:コメントがありません</p>
            @else
                <p class='tool'>コメント:{{$user->introduce}}</p>
            @endif
            @if($user->id == Auth::user()->id)
                <a href='{{ route("profile.edit", ["user" => ($user->id)]) }}'>プロフィールを編集</a>
            @endif
        </div>
        <div>
            <a href='{{ route("profile.posts", ["user" => $user->id]) }}' class='own_posts'>投稿</a>
            <a href="" class='calendar'>カレンダー</a>
            <a href='{{ route("profile.likes", ["user" => $user->id]) }}' class='favorite'>いいね</a>
            <a href='{{ route("bookmarks.show", ["user" => $user->id]) }}' class='menue_type'>ブックマーク</a>
        </div>
        @yield('profile_menue')
    </div>
@endsection

@section('script')
    @yield('script')
@endsection