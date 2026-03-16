<x-header />

<section class="books-head profile-head">
    <div>
        <p class="books-kicker">Profile</p>
        <h1>アカウント設定</h1>
        <p>プロフィール情報やパスワードを管理し、安心して本棚を使い続けられるようにします。</p>
    </div>
    <a href="{{ route('books.index') }}" class="books-btn books-btn-outline books-btn-md">本棚に戻る</a>
</section>

<section class="profile-layout" aria-label="プロフィール設定">
    <div class="profile-main">
        <div class="books-panel profile-card">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="books-panel profile-card">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <aside class="profile-side">
        <div class="books-panel profile-card profile-card-danger">
            @include('profile.partials.delete-user-form')
        </div>
    </aside>
</section>

<x-footer />
