<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    @php
        $isLogin = request()->routeIs('login');
        $isRegister = request()->routeIs('register');
    @endphp
    <body class="landing-body auth-page">
        <div class="landing-orb landing-orb-a" aria-hidden="true"></div>
        <div class="landing-orb landing-orb-b" aria-hidden="true"></div>

        <header class="auth-nav">
            <div class="landing-container auth-nav-inner">
                <a href="{{ url('/') }}" class="landing-brand">TSUNDOKU <span>Manager</span></a>

                <div class="auth-nav-links">
                    <a href="{{ url('/') }}" class="landing-ghost-btn">トップへ戻る</a>
                    @if ($isLogin && Route::has('register'))
                        <a href="{{ route('register') }}" class="landing-main-btn">新規登録</a>
                    @elseif ($isRegister && Route::has('login'))
                        <a href="{{ route('login') }}" class="landing-main-btn">ログイン</a>
                    @elseif (Route::has('login') && !request()->routeIs('login'))
                        <a href="{{ route('login') }}" class="landing-main-btn">ログイン</a>
                    @endif
                </div>
            </div>
        </header>

        <main class="auth-main">
            <div class="landing-container auth-shell">
                <section class="auth-intro">
                    <p class="auth-intro-kicker">TSUNDOKU Manager</p>
                    @if ($isLogin)
                        <h1>積読の管理を、<br>今日から再開する。</h1>
                        <p>ログインして本棚と読書ログを確認。次に読む一冊をすぐ決められます。</p>
                    @elseif ($isRegister)
                        <h1>積読を前進させる<br>アカウントを作成。</h1>
                        <p>本の登録から進捗管理まで、読書習慣を整える準備を3分で始めましょう。</p>
                    @else
                        <h1>読書管理を、<br>もっとシンプルに。</h1>
                        <p>TSUNDOKU Managerで本棚と読書ログをまとめて管理できます。</p>
                    @endif
                </section>

                <section class="auth-card">
                    {{ $slot }}
                </section>
            </div>
        </main>
    </body>
</html>
