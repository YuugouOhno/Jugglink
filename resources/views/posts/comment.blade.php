@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
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