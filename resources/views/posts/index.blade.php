@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>Jugglink</title>
@endsection

@section('main')
    <div class='posts_container'>
        @foreach ($posts as $post)
        <div class='post_container'>
            <div class='user'>
                @if($post->user->icon_path !=0)
                    <img  class='user_icon' src="{{ $post->user->icon_path }}">
                @else
                    <i class="fa-solid fa-circle-user" style="font-size:50px;"></i>
                @endif
                <a  class='user_name' href='{{ route("profile.posts", ["user" => ($post->user->id)]) }}'>{{ $post->user->name }}</a>
            </div>
            <div class='post_title'>
                <p class='tool_number'>{{ $post->tool_number }}</p>
                <a class='tool_name' href='{{ route("tools.show", ["tool" => ($post->tool->id)]) }}'>{{ $post->tool->name }}</a>
                <p class='technique_name'>{{ $post->technique }}</p>
            </div>
            <div class='post_body'>
                <video controls loop autoplay muted>
                    <source src="{{ $post->video_path }}" type="video/mp4">
                </video>
                <p class='post_text'>{{ $post->text }}</p>
            </div>
            <div class='post_reaction'>
                <like-component :post="{{ json_encode($post)}}"></like-component>
                <div class='coment'><a href='{{ route("comments.show", ["post" => ($post->id)])}}'><i class="fa-regular fa-comment"></i></a></div>
                <bookmark-component :post="{{ json_encode($post)}}"></bookmark-component>
            </div>
            @if($post->user->id == Auth::user()->id)
            <form id="posts_delete_form" action='{{ route("posts.delete", ["post" => ($post->id)]) }}' method='POST' enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <input type='button' value='delete' onclick="buttonClick()">
            </form>
            @endif
        </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $posts->links() }}
    </div>
@endsection

@section('script')
    <script>
        function buttonClick(){
            if(confirm("削除しますか？")){
                document.getElementById("posts_delete_form").submit();
            }
        }
    </script>
@endsection