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
</head>

<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-logo">PiGLy</h1>
            <div class="header-link">
                @if(Auth::check())
                <div class="header-link__group">
                    <a href="{{ route('goal_setting') }}" class="header-link-item"><img src="{{ asset('設定アイコン.png') }}" alt=" " class="header-link-icon" />目標体重設定</a>
                </div>
                <div class="header-link__group">
                    <form class="header-link-item" action="/logout" method="post">
                        @csrf
                        <button type="submit" class="logout-button"><img src="{{asset('2512730.png')}}" alt=" " class="header-link-icon">ログアウト</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>