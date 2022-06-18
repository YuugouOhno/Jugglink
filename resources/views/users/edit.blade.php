@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>Jugglink</title>
@endsection

@section('main')
<h1 class="title">編集画面</h1>
    <div class="content">
        <form action="/profiles/users/{{ $user->id }}" method="POST">
            @csrf
            @method('PUT')
            <h2>アイコン</h2>
            <input type='text' name='user[icon]' value="{{ $user->icon }}">
            <h2>名前</h2>
            <input type='text' name='user[name]' value="{{ $user->name }}">
            <h2>道具</h2>
            <select name="user[tool_id]">
                @foreach($tools as $tool)
                    <option value="{{ $tool->id }}"　@if($tool->id == $user->tool->id){echo 'selected'}@endif>{{ $tool->name }}</option>
                @endforeach
            </select>
            <h2>コメント(サブ道具などあれば)</h2>
            <textarea name="user[introduce]"></textarea>
            <input type="submit" value="保存">
        </form>
    </div>
@endsection