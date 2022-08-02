@extends('layouts.app')　

@section('title1')
    <title>Jugglink</title>
    <link href="{{secure_asset('css/home.css')}}" rel="stylesheet">
@endsection

@section('header1')
    @if(Auth::id())
    <a href='/'><h4>Jugglinkへ</h4></a>
    @endif
@endsection

@section('main1')
    <header id="header">
        <div id="video-area">
            <video id="video" webkit-playsinline playsinline muted autoplay loop>
                <source src="https://jugglinkbucket.s3.amazonaws.com/home_pv/home%E5%8B%95%E7%94%BB.mov" type="video/mp4">
            </video>
        </div>
    </header>
    <div class="container_1">
        <div class="top_icon">
            <img src="https://jugglinkbucket.s3.amazonaws.com/jugglink_icon/minil.PNG">
        </div>
        
        <h1>ジャグラーのための</h1>
        <h1>動画投稿サイト</h1>
        <div class="summary">
            <p>Jugglinkは、ジャグラーによるジャグラーのための動画投稿サイトです。
            教えてくれる先輩がいない時、個人でジャグリングを始めたい時、技に刺激を受けたい時などなど
            求めているジャグリングの動画を簡単に見つけることができます。
            また、自分が成功させた技を投稿することで、成長の記録になると同時にジャグラーとのつながりを作ることができます。
            </p>
        </div>
        <button class="register_btn btn" type=“button” onclick="location.href='/register'">
            Jugglinkに登録する
        </button>
    </div>
    <div class="container_2">
        <h2>必要な動画を検索</h2>
        <p>「Twitterでいつだったかに見たあの技はどうやるんだろう、、」
        「あの技を練習したいんだけど身近に教えてくれる人がいない、、、」
        そんな経験がきっとあるはずです。
        Jugglinkでは技名、道具の種類、道具の数、歴、などからジャグリングの動画を探すことが可能です。
        </p>
        <h2>ジャグリング仲間を作る</h2>
        <p>モチベーションの維持には一緒に成長できる、教え合える、競い合える、そんな仲間が必要不可欠です。
        成功させた技を投稿して反応をもらいモチベーションにつなげましょう。
        後から見返した時用の成長記録としても使えますし、これから先ジャグリングを始める後輩たちの助けになります。
        </p>
        <h2>孤独ではない証明</h2>
        <p>自分のコミュニティー以外にもジャグラーはたくさんいます。
        自分の練習場所を共有してジャグラーの分布を作成しましょう。
        あなたの家のすぐ近くにもジャグラーがいるかもしれません。
        </p>
    </div>
    <div class="container_3">
        <h2>
            まずは登録していろんなジャグラーの動画を見てみましょう！！！！！
        </h2>
        <button class="bottom_btn btn" type=“button” onclick="location.href='/register'">
            <img class="l" src="https://jugglinkbucket.s3.amazonaws.com/jugglink_icon/l.PNG">
            <div>
                <h3>に登録する</h3>
            </div>
            
        </button>
    </div>
    <footer>
        <div class="footer_title">
                <h3>Jugglink</h3>
            </div>
        <div class="footer_container">
            
            <div class="footer1">
                <p>ジャグリングとは</p>
                <p>ルーティンとは</p>
                <p>道具の購入方法</p>
                <p>最初のひと技</p>
            </div>
            <div class="footer2">
                <p>大会への出場方法</p>
                <p>新人戦について</p>
                <p>JJFについて</p>
            </div>
            <div class="footer3">
                <p>お問合せ</p>
                <p>mail: xxxxxxxxxxx@gmail.com</p>
                <p>tel: 03-xxxx-xxxx</p>
            </div>
        </div>
    </footer>
@endsectio