@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>Jugglink</title>
@endsection

@section('main')
    <div class='post'>
        @foreach ($posts as $post)
        <div class='user'>
            {{--<image class='icon_image' src=''></image>--}}
            <p class='icon_image'>{{ $post->user->icon }}</p>
            <a href='{{ route("profile.posts", ["user" => ($post->user->id)]) }}' class='user_name'>{{ $post->user->name }}</a>
        </div>
        <div class='post_title'>
            <p class='tool_number'>{{ $post->tool_number }}</p>
            <a href='{{ route("tools.show", ["tool" => ($post->tool->id)]) }}'>{{ $post->tool->name }}</a>
            <p class='technique_name'>{{ $post->technique }}</p>
        </div>
        <div class='post_body'>
            {{--<video class='post_video' src=''></video>--}}
            <p class='post_video'>{{ $post->video }}</p>
            <p class='post_text'>{{ $post->text }}</p>
        </div>
        <div class='post_reaction'>
            <like-component :post="{{ json_encode($post)}}"></like-component>
            <div class='coment'><a href='{{ route("comments.show", ["post" => ($post->id)])}}'><i class="fa-regular fa-comment"></i></a></div>
            <bookmark-component :post="{{ json_encode($post)}}"></bookmark-component>
        </div>
        @if($post->user->id == Auth::user()->id)
        {{--<form id="posts_delete_form" action='{{ route("posts.delete", ["post" => ($post->id)]) }}' method='POST'>
            @csrf
            @method('DELETE')
            <input type='button' value='delete' onclick="buttonClick()">
        </form>--}}
        <deletepost-component :post="{{ json_encode($post)}}"></deletepost-component>
        @endif
        @endforeach
    </div>
    <div class='paginate'>
        {{ $posts->links() }}
    </div>
@endsection

@section('script')
    {{--<script>
        function buttonClick(){
            if(confirm("削除しますか？")){
                document.getElementById("posts_delete_form").submit();
            }
        }
    </script>--}}
@endsection