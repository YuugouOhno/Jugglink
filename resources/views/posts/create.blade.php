<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Link</title>
    </head>
    <body>
        <div class='post_container'>
            <div class='post_header'>
                <h1>新規投稿を作成</h1>
                <div class="back_index"><a href="/">戻る</a></div>
            </div>
            <div class='upload_video'>
                <p>ファイルを選択してください</p>
            </div>
            <div class='post_content'>
                <form action="/posts" method="POST">
                    @csrf
                    <div class="title">
                        <h2>技名</h2>
                        <input type="text" name="post[technique]" placeholder="技名"/>
                        <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                    </div>
                    <div class="body">
                        <h2>コメント</h2>
                        <textarea name="post[post_text]" placeholder="この技のコツは..."></textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    </div>
                    <input type="submit" value="投稿"/>
                </form>
            </div>
        </div>
    </body>
</html>
