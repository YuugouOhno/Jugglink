@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="css/.css">
    <title>Comment</title>
@endsection

@section('main')
    <div class='post'>
        <div class='user'>
            <image class='icon_image' src=''></image>
            <p class='user_name'>{{ $post->user_id }}</p>
        </div>
        <div class='post_title'>
            <p class='tool_number'>{{ $post->tool_number }}</p>
            <p class='tool_name'>{{ $post->tool_name }}</p>
            <p class='technique_name'>{{ $post->technique }}</p>
        </div>
        <div class='post_body'>
            <video class='post_video' src=''></video>
            <p class='post_text'>{{ $post->post_text }}</p>
        </div>
        <div class='post_reaction'>
            <div class='favorite'>いいね</div>
            <div class="back_index"><a href="/">戻る</a></div>
            <div class='bookmark'>ブックマーク</div>
        </div>
    </div>
    <div class='comment'>
        <p>{{ $post->comment->post_text }}</p>
    </div>
@endsection