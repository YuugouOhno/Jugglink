@extends('others.menue')

@section('title2')
    <title>道具/Jugglink</title>
@endsection

@section('header2')
    <h4>道具</h4>
@endsection

@section('main2')
    <div>
        <infinity-component :url="{{ json_encode('/infinity_tools/')}}" :id='{{ json_encode($tool)}}'></infinity-component>
    </div>
@endsection
{{--<div class='post'>
        @foreach ($posts as $post)
        <div class='user'>
            <image class='icon_image' src=''></image>
            <p class='user_name'>{{ $post->user->name }}
        </div>
        <div class='post_title'>
            <p class='tool_number'>{{ $post->tool_number }}</p>
            <a href="/tools/{{ $post->tool->id }}">{{ $post->tool->name }}</a>
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
        {{ $posts->links() }}
    </div>--}}