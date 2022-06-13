<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/index.css">
        <title>Jugglink</title>
    </head>
    <body>
        <div class='main'>
            <div class='left_container'>
                <div class='menues'>
                    <div class='menue btnBox'>
                        <image class='menue_image' src=''></image>
                        <a href='' class='menue_type'>ホーム</a>
                    </div>
                    <div class='menue btnBox'>
                        <image class='menue_image' src=''></image>
                        <a href='' class='menue_type'>プロフィール</a>
                    </div>
                    <div class='menue btnBox'>
                        <image class='menue_image' src=''></image>
                        <a href='' class='menue_type'>ブックマーク</a>
                    </div>
                    <div class='menue btnBox'>
                        <image class='menue_image' src=''></image>
                        <a href='' class='menue_type'>ジャグラー分布</a>
                    </div>
                </div>
                <div class='create_post btnBox'>
                    <p><a href='/create'>投稿する</a></p>
                </div>
            </div>
            <div class='center_container'>
                <div class='post'>
                    @foreach ($posts as $post)
                    <div class='user'>
                        <image class='icon_image' src=''></image>
                        <p class='user_name'>{{ $post->user_id }}</p>
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
                    <form id="form" action='/posts/{{$post->id}}' method='POST'>
                        @csrf
                        @method('DELETE')
                        <input type='button' value='delete' onclick="buttonClick()">
                    </form>
                    @endforeach
                </div>
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>
            </div>
            <div class='right_container'>
                <div class='serch'>
                    <image class='serch_image' src=''></image>
                </div>
                <div class='recommendation'>
                    <div class='post'>
                    @foreach ($posts as $post)
                    <div class='user'>
                        <image class='icon_image' src=''></image>
                        <p class='user_name'>{{ $post->user_id }}</p>
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
            </div>
        </div>
    <script>
        function buttonClick(){
            if(confirm("削除しますか？")){
                document.getElementById("form").submit();
            }
        }
	</script>
    </body>
</html>