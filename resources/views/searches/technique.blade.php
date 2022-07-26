@extends('others.menue')

@section('title2')
    <title>技検索/Jugglink</title>
    <link href="{{secure_asset('css/search.css')}}" rel="stylesheet">
@endsection

@section('header2')
    <h4>技検索</h4>
@endsection

@section('main2')
<div class="search">
    <div class="search_tab_container">
        <div class="search_tab1 BG_color_white">
            <p>投稿を検索</p>
        </div>
        <div class="search_tab2 BG_color_white">
            <p><a href="{{ route('search.user') }}">ユーザーを検索</a></p>
        </div>
        <div class="search_tab3">
            <p class="color_white">.  </p>
        </div>
    </div>
    <div class="search_container">
        <form action="{{ route('search.technique') }}" method="GET">
            @csrf
            <div class="search_tool_number">
                <select name="tool_number" data-toggle="select">
                    <option value="">道具数</option>
                    @foreach (config('const.tool_number') as $toolNumber)
                        <option value="{{ $toolNumber }}" {{$tool_number==$toolNumber ? "selected" : ""}}>{{ $toolNumber }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search_tool_name">
                <select name="tool_name" data-toggle="select">
                    <option value="">道具</option>
                    @foreach ($tools as $tool)
                        <option value="{{ $tool->tool_name }}" {{$tool_id==$tool->id ? "selected" : ""}} >{{ $tool->tool_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search_technique">
                <input type='text' name='technique' value="{{ old('technique', $technique) }}" placeholder="技名を入力">
                <input type="submit" value="&#xf002">
            </div>
        </form>
    </div>
</div>
<div class="searched">
    <infinityposts-component :technique="{{ json_encode($technique)}}" :tool_id="{{ json_encode($tool_id)}}" :tool_number="{{ json_encode($tool_number)}}"></infinityposts-component>
</div>
@endsection