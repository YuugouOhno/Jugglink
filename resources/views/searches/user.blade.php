@extends('others.menue')

@section('title2')
    <title>ユーザー検索/Jugglink</title>
    <link href="{{secure_asset('css/search.css')}}" rel="stylesheet">
@endsection

@section('header2')
    <h4>ユーザー検索</h4>
@endsection

@section('main2')
<div class='posts_container'>
    <div class="search BG_color_white">
        <div class="search_tab_container">
            <div class="search_tab1">
                <p><a href="{{ route('search.technique') }}">投稿を検索</a></p>
            </div>
            <div class="search_tab2 BG_color_white">
                <p>ユーザーを検索</p>
            </div>
            <div class="search_tab3 BG_color_white">
                <p class="color_white">.  </p>
            </div>
        </div>
        <div class="search_container">
            <form action="{{ route('search.user') }}" method="GET">
                @csrf
                <div class="search_user_experience">
                    <select name="user_experience" data-toggle="select">
                        <option value="">歴</option>
                        <option value="">1年未満</option>
                        <option value="">1年以上</option>
                    </select>
                </div>
                <div class="search_user_tool">
                    <select name="tool_name" data-toggle="select">
                        <option value="">メイン道具</option>
                        @foreach ($tools as $tool)
                            <option value="{{ $tool->tool_name }}" {{$tool_name==$tool->tool_name ? "selected" : ""}} >{{ $tool->tool_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search_user">
                    <input type='text' name='user_name' value="{{ old('user_name', $user_name) }}" placeholder="ユーザー名を入力">
                    <input type="submit" value="&#xf002">
                </div>
            </form>
        </div>
    </div>
    <div class="users searched">
        <div>
            <infinityusers-component :tool_id="{{json_encode($tool_id)}}" :user_name="{{json_encode($user_name)}}"></infinityusers-component>
        </div>
    </div>
</div>
@endsection