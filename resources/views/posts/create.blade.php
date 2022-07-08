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
            <div class="form-check">
                <input class="form-check-input" type="radio" name="maker" value="technique" onclick="formSwitch()" checked>
                <label class="form-check-label"> 技</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="maker" value="sequence" onclick="formSwitch()">
                <label class="form-check-label"> シークエンス</label>
            </div>
        
            <div class="tool_name">
                <h2>道具</h2>
                <select name="post[tool_id]">
                    @foreach($tools as $tool)
                        <option value="{{ $tool->id }}">{{ $tool->tool_name }}</option>
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
            <div class="technique">
                <h2 id='not_sequence'>技名</h2>
                <input id="technique" type="text" name="post[technique]" placeholder="技名"/>
                <p class="technique__error" style="color:red">{{ $errors->first('post.technique') }}</p>
            </div>
            <div class="sequence">
                <h2 id='not_technique'>シークエンス</h2>
                <input id="sequence" type="text" name="post[technique]" value="シークエンス"/>
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
    function formSwitch() {
        hoge = document.getElementsByName('maker')
        if (hoge[0].checked) {

            document.getElementById('technique').style.display = "";
            document.getElementById('sequence').style.display = "none";
            document.getElementById('not_technique').style.display = "none";
            document.getElementById('not_sequence').style.display = "";
            document.getElementById('sequence').setAttribute("disabled", true);
        } else if (hoge[1].checked) {

            document.getElementById('technique').style.display = "none";
            document.getElementById('sequence').style.display = "none";
            document.getElementById('not_technique').style.display = "";
            document.getElementById('not_sequence').style.display = "none";
            document.getElementById('sequence').removeAttribute("disabled");
        } else {
            document.getElementById('technique').style.display = "none";
            document.getElementById('sequence').style.display = "none";
            document.getElementById('not_technique').style.display = "none";
            document.getElementById('not_sequence').style.display = "none";
        }
    }
    window.addEventListener('load', formSwitch());
        
    </script>
@endsection