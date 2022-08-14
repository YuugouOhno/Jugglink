@extends('others.menue')

@section('title2')
    <link href="{{secure_asset('css/profile.css')}}" rel="stylesheet">
    <title>@yield('title3')プロフィール/Jugglink</title>
@endsection

@section('header2')
    <h4>@yield('header3')プロフィール</h4>
@endsection

@section('main2')
    <div class='posts_container'>
        <div class='profile_container'>
            <div class="edit_profile">
                @if($user->id == Auth::user()->id)
                    <profilemodal-component :user='{{ json_encode($user)}}'></profilemodal-component>
                @endif
            </div>
            
            <div class='profile_icon_content'>
                @if($user->icon_path !=0)
                    <img class='profile_user_icon border_color_purple' src="{{ $user->icon_path }}">
                @else
                    <i class="fa-solid fa-circle-user profile_user_icon border_color_purple"></i>
                @endif
            </div>
            <div class='profile_contents'>
                <div class='profile_user_name'>
                    <p>{{$user->name}}</p>
                </div>
                <div class='profile_tool'>
                    <p>メイン道具:{{$user->tool->tool_name}}</p>
                </div>
                <div class="profile_date">
                     <p>歴:{{$user->created_at}}</p>
                </div>
                
            </div>
            <div class='profile_text'>
                @if($user->introduce==0)
                    <p>コメント:コメントがありません</p>
                @else
                    <p>コメント:{{$user->introduce}}</p>
                @endif
            </div>
            <div class="follows_container">
                <follow-component :user_id = "{{ json_encode($user->id) }}"></follow-component>
            </div>
            
            <div class="profile_menues">
                <div>
                    <a href='{{ route("profile.posts", ["user" => $user->id]) }}' class='color_black'>投稿</a>
                </div>
                <div>
                    <a href="" class='color_black'>カレンダー</a>
                </div>
                <div>
                    <a href='{{ route("profile.likes", ["user" => $user->id]) }}' class='color_black'>いいね</a>
                </div>
            </div>
        </div>
        @yield('main3')
    </div>
@endsection

@section('script2')
    @yield('script3')
@endsection