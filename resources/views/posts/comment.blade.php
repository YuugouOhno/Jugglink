@extends('others.menue')

@section('title2')
    <title>コメント/Jugglink</title>
@endsection

@section('header2')
    <h4>コメント</h4>
@endsection

@section('main2')
<div>
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
            <div class='reaction_icon like_btn'>
                <like-component :post_id="{{ json_encode($post->id)}}"></like-component>
            </div>
            <div class='reaction_icon comment_btn'>
                <a href="/" class='btn'>
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                </a>
            </div>
            <div class='reaction_icon bookmark_btn'>
                <bookmark-component :post_id="{{ json_encode($post->id)}}"></bookmark-component>
            </div>
            <div class='reaction_icon delete_btn'>
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
    <div>
        <infinitycomments-component :post_id="{{ json_encode($post->id)}}"></infinitycomments-component>
    </div>
    
</div>

    
@endsection

@section('script2')
@endsection