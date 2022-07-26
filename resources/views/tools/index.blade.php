@extends('others.menue')

@section('title2')
    <title>{{$tool->tool_name}}/Jugglink</title>
@endsection

@section('header2')
    <h4>{{$tool->tool_name}}</h4>
@endsection

@section('main2')
    <div class='posts_container'>
        <infinityposts-component :tool_id="{{ json_encode($tool->id)}}"></infinityposts-component>
    </div>
@endsection