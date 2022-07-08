@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>Search Account</title>
@endsection

@section('main')
<div class='posts_container'>
    <div class="search">
        <a href="{{ route('search.technique') }}">投稿を検索</a>
        <p>ユーザーを検索</p>
        <form action="{{ route('search.user') }}" method="GET">
            @csrf

            <div class="form-group">
                <div>
                    <label for="">ユーザー名</label>
                    <div>
                        <input type='text' name='user_name' value="{{ old('user_name', $user_name) }}">
                    </div>
                </div>

                <div>
                    
                    <label for="">メイン道具</label>
                    <select name="tool_name" data-toggle="select">
                        <option value="">全て</option>
                        @foreach ($tools as $tool)
                            <option value="{{ $tool->tool_name }}" {{$tool_name==$tool->tool_name ? "selected" : ""}} >{{ $tool->tool_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="submit" class="btn" value="検索">
                </div>
            </div>
        </form>
    </div>
    
    @foreach ($items as $item)
    <div class='user'>
            @if($item->icon_path !=0)
                <img  class='user_icon' src="{{ $item->icon_path }}">
            @else
                <i class="fa-solid fa-circle-user" style="font-size:50px;"></i>
            @endif
            <a  class='user_name' href='{{ route("profile.posts", ["user" => ($item->id)]) }}'>{{ $item->name }}</a>
        </div>
    @endforeach
</div>
@endsection