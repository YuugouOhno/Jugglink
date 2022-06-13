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
                    <div class='technique_type'>
                        <p>
                           <label><input type="radio" name="post[technique]" value="1" onclick="checkradio('inline');" >技</label>
                           <label><input type="radio" name="post[technique]" value="2" onclick="checkradio('none');">シークエンス</label>
                        </p>
                    </div>
                    <div class="tool_name">
                        <h2>道具</h2>
                        <select name="post[tool_id]">
                            @foreach($tools as $tool)
                                <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='tool_number'>
                        <select name="post[tool_number]">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div id="technique" class="technique">
                        <h2>技名</h2>
                        <input type="text" name="post[technique]" placeholder="技名"/>
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
    <script>
        function checkradio( disp ) {
           document.getElementById('technique').style.display = disp;
        }
    </script>
    </body>
</html>
