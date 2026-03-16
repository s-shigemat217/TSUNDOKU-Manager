<section class="profile-section profile-section-danger">
    <header class="profile-section-head">
        <h2>アカウント削除</h2>

        <p>
            退会すると、登録したデータを含むアカウント情報は完全に削除されます。
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="profile-danger-trigger"
    >アカウントを削除する</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="profile-modal-form">
            @csrf
            @method('delete')

            <h2 class="profile-modal-title">
                本当にアカウントを削除しますか？
            </h2>

            <p class="profile-modal-text">
                削除後はプロフィール、本棚、関連データを復元できません。続行する場合は現在のパスワードを入力してください。
            </p>

            <div class="profile-field">
                <x-input-label for="password" value="パスワード" class="profile-label sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="profile-input profile-modal-input"
                    placeholder="パスワード"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="profile-errors" />
            </div>

            <div class="profile-modal-actions">
                <x-button type="button" variant="outline" x-on:click="$dispatch('close')">
                    キャンセル
                </x-button>

                <x-button variant="danger">
                    削除する
                </x-button>
            </div>
        </form>
    </x-modal>
</section>
