@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>Jugglink</title>
@endsection

@section('main')
    <div class='post_header'>
        <h1>新規投稿を作成</h1>
        <div class="back_index"><a href="/">戻る</a></div>
    </div>
    <div class='post_content'>
        <form action='{{ route("posts.create") }}' method="POST"  enctype="multipart/form-data">
            
            <div class="video">
                <h2>動画</h2>
                <input type='file' name="video">
            </div>
            @csrf
            <div class='technique_type'>
                <p>
                   <label><input type="radio" value="1" onclick="checkradio('inline');" >技</label>
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
                <p class="tool_name__error" style="color:red">{{ $errors->first('post.tool_name') }}</p>
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
                <p class="tool_number__error" style="color:red">{{ $errors->first('post.tool_number') }}</p>
            </div>
            <div id="technique" class="technique">
                <h2>技名</h2>
                <input type="text" name="post[technique]" placeholder="技名"/>
                <p class="technique__error" style="color:red">{{ $errors->first('post.technique') }}</p>
            </div>
            <div class="text">
                <h2>コメント</h2>
                <textarea name="post[text]" placeholder="この技のコツは..."></textarea>
                <p class="text__error" style="color:red">{{ $errors->first('post.text') }}</p>
            </div>
            <button type="submit">投稿する</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        function checkradio( disp ) {
           document.getElementById('technique').style.display = disp;
        }
    </script>
@endsection