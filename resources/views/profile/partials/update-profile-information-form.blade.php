<section class="profile-section">
    <header class="profile-section-head">
        <h2>プロフィール情報</h2>

        <p>
            アカウント名とメールアドレスを更新します。
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="profile-form">
        @csrf
        @method('patch')

        <div class="profile-field">
            <x-input-label for="name" value="名前" class="profile-label" />
            <x-text-input id="name" name="name" type="text" class="profile-input" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="profile-errors" :messages="$errors->get('name')" />
        </div>

        <div class="profile-field">
            <x-input-label for="email" value="メールアドレス" class="profile-label" />
            <x-text-input id="email" name="email" type="email" class="profile-input" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="profile-errors" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="profile-note-wrap">
                    <p class="profile-note">
                        メールアドレスは未認証です。

                        <button form="send-verification" class="profile-inline-action">
                            認証メールを再送する
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="profile-status is-success">
                            認証用リンクをメールアドレスに再送しました。
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="profile-action-row">
            <x-button type="submit">保存する</x-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="profile-status"
                >保存しました。</p>
            @endif
        </div>
    </form>
</section>
