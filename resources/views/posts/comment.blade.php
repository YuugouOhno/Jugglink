@extends('others.menue')

@section('title2')
    <title>コメント/Jugglink</title>
@endsection

@section('header2')
    <h4>コメント</h4>
@endsection

@section('main2')
    <div class='post'>
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
    </div>
    </div>
    <div class='create_comment'>
        <form action="/posts/{{$post->id}}/comments/create" method="POST">
            @csrf
            <div>
                <textarea name="comment[text]" placeholder="コメント"></textarea>
                <p class="video__error" style="color:red">{{ $errors->first('post.video') }}</p>
                <input type="submit" value="コメントを投稿"/>
            </div>
        </form>
    </div>
    <div class='comment'>
        @foreach ($post->comments as $comment)
            <p>{{ $comment->user->icon }}</p>
            <a href='/profiles/users/{{$comment->user->id}}' class='user_name'>{{ $comment->user->name }}</a>
            <p>{{ $comment->text }}</p>
            @if($comment->user->id == Auth::user()->id)
            <form id="comments_delete_form" action="/posts/comments/{{$comment->id}}/delete" method='POST'>
                @csrf
                @method('DELETE')
                <input type='button' value='delete' onclick="buttonClick()">
            </form>
            @endif
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        function buttonClick(){
            if(confirm("削除しますか？")){
                document.getElementById("comments_delete_form").submit();
            }
        }
	</script>
@endsection