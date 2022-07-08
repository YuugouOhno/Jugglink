@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>Search Technique</title>
@endsection

@section('main')
<div class='posts_container'>
    <div class="search">
        <p>投稿を検索</p>
        <a href="{{ route('search.user') }}">ユーザーを検索</a>
        <form action="{{ route('search.technique') }}" method="GET">
            @csrf

            <div class="form-group">
                <div>
                    <label for="">技名</label>
                    <div>
                        <input type='text' name='technique' value="{{ old('technique', $technique) }}">
                    </div>
                </div>

                <div>
                    <label for="">道具の種類</label>
                    <select name="tool_name" data-toggle="select">
                        <option value="">全て</option>
                        @foreach ($tools as $tool)
                            <option value="{{ $tool->tool_name }}" {{$tool_name==$tool->tool_name ? "selected" : ""}} >{{ $tool->tool_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="">道具の数</label>
                    <select name="tool_number" data-toggle="select">
                        <option value="">全て</option>
                        @foreach (config('const.tool_number') as $toolNumber)
                            <option value="{{ $toolNumber }}" {{$tool_number==$toolNumber ? "selected" : ""}}>{{ $toolNumber }}</option>
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
            <a  class='user_name' href='{{ route("profile.posts", ["user" => ($item->user_id)]) }}'>{{ $item->name }}</a>
        </div>
        <div class='post_title'>
            <p class='tool_number'>{{ $item->tool_number }}</p>
            <a class='tool_name' href='{{ route("tools.show", ["tool" => ($item->tool_id)]) }}'>{{ $item->tool_name }}</a>
            <p class='technique_name'>{{ $item->technique }}</p>
        </div>
        <div class='post_body'>
            <video controls loop autoplay muted>
                <source src="{{ $item->video_path }}" type="video/mp4">
            </video>
            <p class='post_text'>{{ $item->text }}</p>
        </div>
        <div class='post_reaction'>
            <like-component :post="{{ json_encode($item)}}"></like-component>
            <button class='btn' onclick="location.href='{{ route("comments.show", ["post" => ($item->id)])}}'">
                <i class="fa-regular fa-comment" style="color:purple;"></i>
            </button>
            <bookmark-component class='bookmark' :post="{{ json_encode($item)}}"></bookmark-component>
            @if($item->user_id == Auth::user()->id)
            <form class='delete' id="posts_delete_form" action='{{ route("posts.delete", ["post" => ($item->id)]) }}' method='POST' enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <button class='btn' onclick="buttonClick()">
                    <i class="fa-regular fa-trash-can" style="color:glay;"></i>
                </button>
            </form>
            @endif
        </div>
    @endforeach
</div>
@endsection