@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="css/index.css">
    <title>bookmark</title>
@endsection

@section('main')
    <div class='post'>
        @foreach ($bookmark_posts as $post)
        <div class='user'>
            <image class='icon_image' src=''></image>
            {{--<p class='user_name'>{{ $post->user->name }}</p>--}}
        </div>
        <div class='post_title'>
            <p class='tool_number'>{{ $post->tool_number }}</p>
            {{--<a href="/tools/{{ $post->tool->id }}">{{ $post->tool->name }}</a>--}}
            <p class='technique_name'>{{ $post->technique }}</p>
        </div>
        <div class='post_body'>
            <video class='post_video' src=''></video>
            <p class='post_text'>{{ $post->post_text }}</p>
        </div>
        <div class='post_reaction'>
            <div class='favorite'>いいね</div>
            <div class='coment'><a href="/posts/{{ $post->id }}">コメント</a></div>
            <div class='bookmark'>ブックマーク</div>
        </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $bookmark_osts->links() }}
    </div>
@endsection