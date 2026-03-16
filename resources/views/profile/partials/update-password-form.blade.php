<section class="profile-section">
    <header class="profile-section-head">
        <h2>パスワード変更</h2>

        <p>
            推測されにくいパスワードに更新して、アカウントを保護します。
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="profile-form">
        @csrf
        @method('put')

        <div class="profile-field">
            <x-input-label for="update_password_current_password" value="現在のパスワード" class="profile-label" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="profile-input" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="profile-errors" />
        </div>

        <div class="profile-field">
            <x-input-label for="update_password_password" value="新しいパスワード" class="profile-label" />
            <x-text-input id="update_password_password" name="password" type="password" class="profile-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="profile-errors" />
        </div>

        <div class="profile-field">
            <x-input-label for="update_password_password_confirmation" value="新しいパスワード（確認）" class="profile-label" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="profile-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="profile-errors" />
        </div>

        <div class="profile-action-row">
            <x-button type="submit">更新する</x-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="profile-status"
                >更新しました。</p>
            @endif
        </div>
    </form>
</section>
