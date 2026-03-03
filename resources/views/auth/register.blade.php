<x-guest-layout>
    <div class="auth-form-head">
        <h2>新規登録</h2>
        <p>無料でアカウントを作成して、積読の見える化を始めましょう。</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <x-input-label for="name" class="auth-label" value="表示名" />
            <x-text-input
                id="name"
                class="auth-input block mt-2 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="auth-error mt-2" />
        </div>

        <div class="auth-field">
            <x-input-label for="email" class="auth-label" value="メールアドレス" />
            <x-text-input
                id="email"
                class="auth-input block mt-2 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="auth-error mt-2" />
        </div>

        <div class="auth-field">
            <x-input-label for="password" class="auth-label" value="パスワード" />
            <x-text-input
                id="password"
                class="auth-input block mt-2 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="auth-error mt-2" />
        </div>

        <div class="auth-field">
            <x-input-label for="password_confirmation" class="auth-label" value="パスワード（確認）" />
            <x-text-input
                id="password_confirmation"
                class="auth-input block mt-2 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="auth-error mt-2" />
        </div>

        <button type="submit" class="auth-submit-btn">
            アカウントを作成
        </button>

        @if (Route::has('login'))
            <p class="auth-switch">
                すでに登録済みの方は
                <a href="{{ route('login') }}">ログイン</a>
            </p>
        @endif
    </form>
</x-guest-layout>
