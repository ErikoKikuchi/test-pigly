<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register_step1.css') }}" />
</head>

<body>
    <div class="background-image">
        <div class="register-form">
            <div class="register-form__top">
                <h1 class="register-form__title">PiGLy</h1>
                <h2 class="register-form__subtitle">新規会員登録</h2>
                <p class="register-form__explanation">STEP1 アカウント情報の登録</p>
            </div>
            <div class="register-form__contents">
                <form class="register-form__inner" action="/register/step1" method="post" novalidate>
                    @csrf
                    <div class="register-form__name">
                        <label class="register-form__label" for="name">お名前</label>
                        <input type="text" id="name" name="name" class="register-form__input" value="{{ old('name') }}" placeholder="名前を入力">
                    </div>
                    <div class="error-message">
                        @if ($errors->has('name'))
                        <p class="register-form__error-message">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="register-form__email">
                        <label class="register-form__label" for="email">メールアドレス</label>
                        <input type="email" id="email" name="email" class="register-form__input" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                    </div>
                    <div class="error-message">
                        @foreach ($errors->get('email') as $message)
                        <p class="register-form__error-message">{{ $message }}</p>
                        @endforeach
                    </div>
                    <div class="register-form__password">
                        <label class="register-form__label" for="password">パスワード</label>
                        <input type="password" id="password" name="password" class="register-form__input" placeholder="パスワードを入力">
                    </div>
                    <div class="error-message">
                        @if ($errors->has('password'))
                        <p class="register-form__error-message">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="register-form__bottom">
                        <button type="submit" class="register-form__button">次に進む</button>
                    </div>
                </form>
                <div class="move-to-login">
                    <a class="login__button" href="/login">ログインはこちら</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>