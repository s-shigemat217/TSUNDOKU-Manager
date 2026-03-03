<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="landing-body books-body">
    <div class="landing-orb landing-orb-a" aria-hidden="true"></div>
    <div class="landing-orb landing-orb-b" aria-hidden="true"></div>

    <header class="books-nav">
        <div class="landing-container books-nav-inner">
            <a href="{{ url('/') }}" class="landing-brand">TSUNDOKU <span>Manager</span></a>

            <nav class="books-nav-links" aria-label="本棚メニュー">
                <a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.index') ? 'is-active' : '' }}">本棚</a>
                <a href="{{ route('books.create') }}" class="{{ request()->routeIs('books.create') ? 'is-active' : '' }}">本を追加</a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'is-active' : '' }}">プロフィール</a>
            </nav>

            <div class="books-nav-user">
                @auth
                    <span>{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="books-logout-btn">ログアウト</button>
                    </form>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="landing-main-btn">ログイン</a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <main class="books-main">
        <div class="landing-container books-shell">
