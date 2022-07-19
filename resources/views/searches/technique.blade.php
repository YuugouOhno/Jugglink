@extends('others.menue')

@section('title2')
    <title>技検索/Jugglink</title>
    <link href="{{secure_asset('css/search.css')}}" rel="stylesheet" >
@endsection

@section('header2')
    <h4>技検索</h4>
@endsection

@section('main2')
<div class='posts_container'>
    <div class="search">
        <p>投稿を検索</p>
        <a href="{{ route('search.user') }}">ユーザーを検索</a>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <form action="{{ route('search.technique') }}" method="GET">
            @csrf
            <div class="search_container">
                <div class="search_tool_number">
                    <select name="tool_number" data-toggle="select">
                        <option value="">道具数</option>
                        @foreach (config('const.tool_number') as $toolNumber)
                            <option value="{{ $toolNumber }}" {{$tool_number==$toolNumber ? "selected" : ""}}>{{ $toolNumber }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search_tool_name">
                    <select name="tool_name" data-toggle="select">
                        <option value="">道具</option>
                        @foreach ($tools as $tool)
                            <option value="{{ $tool->tool_name }}" {{$tool_id==$tool->id ? "selected" : ""}} >{{ $tool->tool_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search_technique">
                    <input type='text' name='technique' value="{{ old('technique', $technique) }}" placeholder="技名を入力">
                    <input type="submit" value="&#xf002">
                </div>
            </div>
            
        </form>
    </div>
    <div>
        <infinityposts-component :technique="{{ json_encode($technique)}}" :tool_id="{{ json_encode($tool_id)}}" :tool_number="{{ json_encode($tool_number)}}"></infinityposts-component>
    </div>
    {{--
    @foreach ($posts as $post)
    <div class='post_container'>
        <div>
            <a class='color_black' href='{{ route("profile.posts", ["user" => ($post->user->id)]) }}'>
                <div class="user">
                    @if($post->user->icon_path !=0)
                    <img class="user_icon" src="{{ $post->user->icon_path }}">
                    @else
                        <i class="fa-solid fa-circle-user user_icon"></i>
                    @endif
                    <p class='user_name'>{{ $post->user->name }}</p>
                </div>
            </a>
        </div>
        <div class='video'>
            <video controls loop autoplay muted>
                <source src="{{ $post->video_path }}" type="video/mp4">
            </video>
        </div>
        <div class='post_titles'>
            <p class='tool_number post_titles color_black'>{{ $post->tool_number }}</p>
            <a class='tool_name post_titles color_black'  href='{{ route("tools.show", ["tool" => ($post->tool->id)]) }}'>{{ $post->tool->tool_name }}</a>
            <p class='technique_name post_titles color_black'>{{ $post->technique }}</p>
        </div>
        <div class='post_text'>
            <p class='color_black'>{{ $post->text }}</p>
        </div>
        <div class='post_reaction'>
            <div class='reaction_icon'>
                <like-component :post="{{ json_encode($post)}}"></like-component>
            </div>
            <div class='reaction_icon'>
                <button class='btn' onclick="location.href='{{ route("comments.show", ["post" => ($post->id)])}}'">
                    <i class="fa-regular fa-comment color_black"></i>
                </button>
            </div>
            <div class='reaction_icon'>
                 <bookmark-component class='bookmark' :post="{{ json_encode($post)}}"></bookmark-component>
            </div>
            <div class='reaction_icon'>
                @if($post->user->id == Auth::user()->id)
                <form id="posts_delete_form" action='{{ route("posts.delete", ["post" => ($post->id)]) }}' method='POST' enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button class='btn' onclick="buttonClick()">
                        <i class="fa-regular fa-trash-can color_gray"></i>
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    --}}
</div>
@endsection