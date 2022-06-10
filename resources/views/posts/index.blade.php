<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/index.css">
        <title>Jugglink</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class='main'>
            <div class='left_container'>
                <div class='menues'>
                    <div class='menue btnbox'>
                        <image class='menue_image' src=''></image>
                        <a href='' class='menue_type'>ホーム</a>
                    </div>
                    <div class='menue btnbox'>
                        <image class='menue_image' src=''></image>
                        <a href='' class='menue_type'>プロフィール</a>
                    </div>
                    <div class='menue btnbox'>
                        <image class='menue_image' src=''></image>
                        <a href='' class='menue_type'>ブックマーク</a>
                    </div>
                    <div class='menue btnbox'>
                        <image class='menue_image' src=''></image>
                        <a href='' class='menue_type'>ジャグラー分布</a>
                    </div>
                </div>
                <div class='create_post'>
                    <input type='button' value='投稿する' onclick="buttonClick()">
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
                        <p class='tool_name'>{{ $post->tool_name }}ス</p>
                        <p class='technique_name'>{{ $post->technique }}</p>
                    </div>
                    <div class='post_body'>
                        <video class='post_video' src=''></video>
                        <p class='post_text'>{{ $post->post_text }}</p>
                    </div>
                    <div class='post_reaction'>
                        <div class='favorite'>いいね</div>
                        <div class='coment'>コメント</div>
                        <div class='bookmark'>ブックマーク</div>
                    </div>
                    @endforeach
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
                        <p class='tool_name'>{{ $post->tool_name }}ス</p>
                        <p class='technique_name'>{{ $post->technique }}</p>
                    </div>
                    <div class='post_body'>
                        <video class='post_video' src=''></video>
                        <p class='post_text'>{{ $post->post_text }}</p>
                    </div>
                    <div class='post_reaction'>
                        <div class='favorite'>いいね</div>
                        <div class='coment'>コメント</div>
                        <div class='bookmark'>ブックマーク</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>