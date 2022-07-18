@extends('others.menue')

@section('title2')
    <title>プロフィールの編集/Jugglink</title>
@endsection

@section('header2')
    <h4>プロフィールの編集</h4>
@endsection

@section('main2')
<h1 class="title">編集画面</h1>
    <div class="content">
        <form action='{{ route("profile.update", ["user" => ($user->id)]) }}' method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="icon">
                <h2>アイコン</h2>
                <input type='file' name="icon">
            </div>
            
            <h2>名前</h2>
            <input type='text' name='user[name]' value="{{ $user->name }}">
            <h2>道具</h2>
            <select name="user[tool_id]">
                <option value="">未選択</option>
                @foreach($tools as $tool)
                    <option value="{{ $tool->id }}">{{ $tool->tool_name }}</option>
                @endforeach
            </select>
            <h2>コメント(サブ道具などあれば)</h2>
            <textarea name="user[introduce]"></textarea>
            <input type="submit" value="保存">
        </form>
    </div>
@endsection