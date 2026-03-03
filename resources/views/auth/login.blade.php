<x-guest-layout>
    <div class="auth-form-head">
        <h2>ログイン</h2>
        <p>登録済みのアカウントでTSUNDOKU Managerにアクセスします。</p>
    </div>

    <x-auth-session-status class="auth-session-status" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <x-input-label for="email" class="auth-label" value="メールアドレス" />
            <x-text-input
                id="email"
                class="auth-input block mt-2 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
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
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="auth-error mt-2" />
        </div>

        <label for="remember_me" class="auth-checkbox-label">
            <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
            <span>ログイン状態を保持する</span>
        </label>

        <div class="auth-form-actions">
            @if (Route::has('password.request'))
                <a class="auth-text-link" href="{{ route('password.request') }}">
                    パスワードを忘れた場合
                </a>
            @endif

            <button type="submit" class="auth-submit-btn">
                ログイン
            </button>
        </div>

        @if (Route::has('register'))
            <p class="auth-switch">
                アカウントをお持ちでない方は
                <a href="{{ route('register') }}">新規登録</a>
            </p>
        @endif
    </form>
</x-guest-layout>
