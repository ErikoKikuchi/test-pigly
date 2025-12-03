<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register_step2.css') }}" />
</head>

<body>
    <div class="register-form">
        <div class="register-form__top">
            <h1 class="register-form__title">PiGLy</h1>
            <h2 class="register-form__subtitle">新規会員登録</h2>
            <p class="register-form__explanation">STEP2 体重データの入力</p>
        </div>
        <div class="register-form__contents">
            <form class="register-form__inner" action="/register/step2" method="post">
                @csrf
                <!--日時とユーザーIDを取得してhiddenで送信-->
                <input type="hidden" name="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d')}}">
                <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                <!--体重入力フォーム-->
                <div class="register-form__weight">
                    <label class="register-form__label" for="weight">現在の体重</label>
                    <input type="text" id="weight" name="weight" class="register-form__input" value="{{ old('weight') }}" placeholder="現在の体重を入力">kg
                </div>
                <div class="error-message">
                    @foreach ($errors->get('weight') as $message)
                    <p class="register-form__error-message">{{ $message }}</p>
                    @endforeach
                </div>
                <div class="register-form__weight">
                    <label class="register-form__label" for="target_weight">目標の体重</label>
                    <input type="text" id="target_weight" name="target_weight" class="register-form__input" value="{{ old('target_weight') }}" placeholder="目標の体重を入力">kg
                </div>
                <div class="error-message">
                    @foreach ($errors->get('target_weight') as $message)
                    <p class="register-form__error-message">{{ $message }}</p>
                    @endforeach
                </div>
                <div class="register-form__bottom">
                    <button type="submit" class="register-form__button">アカウント作成</button>
                </div>
            </form>
</body>

</html>