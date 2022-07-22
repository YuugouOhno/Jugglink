<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{secure_asset('css/index.css')}}" rel="stylesheet" >
    <link href="{{secure_asset('css/responsive.css')}}" rel="stylesheet">
    @yield('title1')
</head>
<body>
    <div id="app">
        <header class="BG_color_purple">
            <div class="head_container">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm BG_color_purple">
                    <div class="container BG_color_purple">
                        <div class="header_title">
                            @yield('header1')
                        </div>
                        
                        {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class='color_white'>ssss</span></span>
                        </button>--}}
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><span class="color_white">{{ __('ログイン') }}</span></a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}"><span class="color_white">{{ __('新規登録') }}</span></a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle BG_color_purple" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('ログアウト') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                        {{--<div class="collapse navbar-collapse BG_color_purple" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                            </ul>
                            <!-- Right Side Of Navbar -->
                        </div>--}}
                    </div>
                </nav>
            </div>
        </header>
        <div class='body_container' id="body_container">
            @yield('main1')
        </div>
    </div>
    <script src="{{ secure_asset('js/app.js') }}" type="module"></script>
    @yield('script1')
</body>
</html>
