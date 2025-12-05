<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <div class="top-message">
        @if (session('success'))
        <div class="message">
            <p class="success-message__text">{{ session('success') }}</p>
        </div>
        @endif
        @if($errors->has('email'))
        <div class="message">
            <div class="error-message__text">
                {{ $errors->first('email') }}
            </div>
        </div>
        @endif
    </div>
    <div class="background-image">
        <div class="login-form">
            <div class="login-form__top">
                <h1 class="login-form__title">PiGLy</h1>
                <h2 class="login-form__subtitle">ログイン</h2>
            </div>
            <div class="login-form__contents">
                <form class="login-form__inner " action="/login" method="post" novalidate>
                    @csrf
                    <div class="login-form__email">
                        <label class="login-form__label" for="email">メールアドレス</label>
                        <input type="email" id="email" name="email" class="login-form__input" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                    </div>
                    <div class="error-message">
                        @foreach ($errors->get('email') as $message)
                        <p class="login-form__error-message">{{ $message }}</p>
                        @endforeach
                    </div>
                    <div class="login-form__password">
                        <label class="login-form__label" for="password">パスワード</label>
                        <input type="password" id="password" name="password" class="login-form__input" placeholder="パスワードを入力">
                    </div>
                    <div class="error-message">
                        @foreach ($errors->get('password') as $message)
                        <p class="login-form__error-message">{{ $message }}</p>
                        @endforeach
                    </div>
                    <div class="login-form__bottom">
                        <button type="submit" class="login-form__button">ログイン</button>
                    </div>
                </form>
                <div class="move-to-register">
                    <a class="register__button" href="/register/step1">アカウント作成はこちら</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>