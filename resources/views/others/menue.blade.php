<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @yield('title')
    </head>
    <body>
        <div class='menues_container'>
            <div class='menues'>
                <div class='menue btnBox'>
                    <image class='menue_image' src=''></image>
                    <a href='/' class='menue_type'>ホーム</a>
                </div>
                <div class='menue btnBox'>
                    <image class='menue_image' src=''></image>
                    <a href='/user' class='menue_type'>プロフィール</a>
                </div>
                <div class='menue btnBox'>
                    <image class='menue_image' src=''></image>
                    <a href='/bookmark' class='menue_type'>ブックマーク</a>
                </div>
                <div class='menue btnBox'>
                    <image class='menue_image' src=''></image>
                    <a href='' class='menue_type'>ジャグラー分布</a>
                </div>
            </div>
            <div class='create_post btnBox'>
                <p><a href='/create'>投稿する</a></p>
            </div>
        </div>
        <div class='main_container'>
            @yield('main')
        </div>
    @yield('script')
    </body>
</html>