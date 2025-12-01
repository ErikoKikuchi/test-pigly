<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
    @livewireStyles
</head>

<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-logo">PiGLy</h1>
            @if(Auth::check())
                <div class="header-link">
                    <div class="header-link__group">
                        <img src="{{ asset('/src/public/設定アイコン.png') }}" alt="設定アイコン" class="header-link-icon" />
                        <a href="{{ route('goal_setting') }}" class="header-link-item">目標体重設定</a>
                    </div>
                    <div class="header-link__group">
                        <img src="{{asset('/src/public/ログアウト.png')" alt="ログアウトアイコン" class="header-link-icon">
                        <a href="{{ route('login') }}" class="header-link-item">ログアウト</a>
                    </div>
                </div>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    @livewireScripts
</body>

</html>