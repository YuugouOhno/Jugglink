@extends('layouts.app')

@section('title1')
    <title>新規登録/Jugglink</title>
@endsection

@section('main1')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('アカウント名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="tool_id" class="col-md-4 col-form-label text-md-right">{{ __('メイン道具') }}</label>

                            <div class="col-md-6">
                                <select id="tool_id" type="tool_id" class="form-control @error('tool_id') is-invalid @enderror" name="tool_id" required autocomplete="tool_id">
                                    <option value="">道具を選択してください</option>
                                    <option value=1>シガーボックス</option>
                                    <option value=2>ディアボロ</option>
                                    <option value=3>ボール</option>
                                    <option value=4>クラブ</option>
                                    <option value=5>ポイ</option>
                                    <option value=6>フラワースティック</option>
                                    <option value=7>デビルスティック</option>
                                    <option value=8>ヨーヨー</option>
                                    <option value=9>コンタクト</option>
                                    <option value=10>スピニングブレード</option>
                                    <option value=11>シェイカーカップ</option>
                                    <option value=12>ハット</option>
                                    <option value=13>リング</option>
                                    <option value=14>スタッフ</option>
                                    <option value=15>エイトリング</option>
                                    <option value=16>けん玉</option>
                                    <option value=17>ダイス</option>
                                    <option value=18>ダポクト</option>
                                    <option value=19>その他</option>
                                </select>
                                @error('tool_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('始めたのはいつ？') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required autocomplete="start_date">
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワードの確認') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary BG_color_purple">
                                    {{ __('新規登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
