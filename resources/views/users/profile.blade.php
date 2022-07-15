@extends('others.menue')

@section('title2')
    <title>@yield('title3')プロフィール/Jugglink</title>
@endsection

@section('header2')
    <h4>@yield('header3')プロフィール</h4>
@endsection

@section('main2')
    <div class='posts_container'>
        <div>
            @if($user->icon_path !=0)
                <img  class='user_icon' src="{{ $user->icon_path }}">
            @else
                <i class="fa-solid fa-circle-user" style="font-size:50px;"></i>
            @endif
            <p class='user_name'>{{$user->name}}</p>
            @if($user->tool)
                <p class='tool'>道具:{{$user->tool->tool_name}}</p>
            @else
                <p class='tool'>道具:道具が未選択です</p>
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
        @yield('main3')
    </div>
@endsection

@section('script2')
    @yield('script3')
@endsection