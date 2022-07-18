@extends('others.menue')

@section('title2')
    <title>ユーザー検索/Jugglink</title>
@endsection

@section('header2')
    <h4>ユーザー検索</h4>
@endsection

@section('main2')
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
    
    @foreach ($users as $user)
    <div>
        <a class='color_black' href='{{ route("profile.posts", ["user" => ($user->id)]) }}'>
            <div class="user">
                @if($user->icon_path !=0)
                <img class="user_icon" src="{{ $user->icon_path }}">
                @else
                    <i class="fa-solid fa-circle-user user_icon"></i>
                @endif
                <p class='user_name'>{{ $user->name }}</p>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection