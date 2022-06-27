@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>Jugglink</title>
@endsection

@section('main')
    <form method="GET" action="">
        <input type="search" placeholder="技名を入力" name="search">
        <div>
            <button type="submit">検索</button>
            <button>
                <a href="" class="text-white">
                    クリア
                </a>
            </button>
        </div>
    </form>
@endsection