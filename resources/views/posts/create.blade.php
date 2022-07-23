@extends('others.menue')

@section('title2')
    <title>投稿の作成/Jugglink</title>
@endsection

@section('header2')
    <h4>投稿の作成</h4>
@endsection

@section('main2')
    
    <div class='main_container'>
        <div class='post_header'>
            <h1>新規投稿を作成</h1>
            <div class="back_index"><a href="/">戻る</a></div>
        </div>
        <div class='post_content'>
            <form action='{{ route("posts.create") }}' method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="video">
                    <p>動画</p>
                    <input type='file' name="fileData">
                </div>
                <p class="video__error" style="color:red">{{ $errors->first('post.video') }}</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="maker" value="technique" onclick="formSwitch()" checked>
                    <label class="form-check-label"> 技</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="maker" value="sequence" onclick="formSwitch()">
                    <label class="form-check-label"> シークエンス</label>
                </div>
                <div class="post_titles">
                    <div class="tool_name post_title">
                        <select name="post[tool_id]">
                            <option value="">道具を選択してください</option>
                            @foreach($tools as $tool)
                            <option value="{{ $tool->id }}">{{ $tool->tool_name }}</option>
                            @endforeach
                        </select>
                        <p class="tool_id__error" style="color:red">{{ $errors->first('post.tool_id') }}</p>
                    </div>
                    <div class='tool_number post_title'>
                        <select name="tool_number">
                            <option value="">道具の数を選択してください</option>
                            @foreach (config('const.tool_number') as $toolNumber)
                            <option value="{{ $toolNumber }}">{{ $toolNumber }}</option>
                            @endforeach
                        </select>
                        <p class="tool_number__error" style="color:red">{{ $errors->first('post.tool_number') }}</p>
                    </div>
                    
                    <div class="technique post_title">
                        <h2 id='not_sequence'></h2>
                        <input id="technique" type="text" name="post[technique]" placeholder="技名"/>
                        <p class="technique__error" style="color:red">{{ $errors->first('post.technique') }}</p>
                    </div>
                    
                    <div class="sequence post_title">
                        <p id='not_technique'>シークエンス</p>
                        <input id="sequence" type="text" name="post[technique]" value="シークエンス"/>
                    </div>
                </div>
                
                <div class="text">
                    <p>コメント</p>
                    <textarea name="post[text]" placeholder="この技のコツは..."></textarea>
                    <p class="text__error" style="color:red">{{ $errors->first('post.text') }}</p>
                </div>
                <button type="submit">投稿する</button>
            </form>
        </div>
    </div>
@endsection

@section('script2')
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