<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="TSUNDOKU Managerは、積読を可視化して次に読む一冊を決めやすくする読書管理サービスです。">

        <title>TSUNDOKU Manager | 積読を読み切る読書管理サービス</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="landing-body">
        <div class="landing-orb landing-orb-a" aria-hidden="true"></div>
        <div class="landing-orb landing-orb-b" aria-hidden="true"></div>

        <header class="landing-nav">
            <div class="landing-container landing-nav-inner">
                <a href="{{ url('/') }}" class="landing-brand">TSUNDOKU <span>Manager</span></a>

                <nav class="landing-links" aria-label="主要メニュー">
                    <a href="#features">機能</a>
                    <a href="#flow">使い方</a>
                    <a href="#start">はじめる</a>
                </nav>

                <div class="landing-auth">
                    @auth
                        <a href="{{ route('dashboard') }}" class="landing-ghost-btn">ダッシュボード</a>
                        <a href="{{ route('books.index') }}" class="landing-main-btn">本棚を開く</a>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="landing-ghost-btn">ログイン</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="landing-main-btn">無料で始める</a>
                        @endif
                    @endauth
                </div>
            </div>
        </header>

        <main>
            <section class="landing-hero" id="top">
                <div class="landing-container landing-hero-grid">
                    <div class="landing-copy">
                        <p class="landing-pill">積読管理を、もっとシンプルに</p>
                        <h1>読みたい本を、<br>積んだままにしない。</h1>
                        <p class="landing-lead">
                            TSUNDOKU Manager は、本の登録・読書状況・購入コストまでまとめて管理。
                            迷わず次の一冊を選べる、読書習慣のためのホームです。
                        </p>

                        <div class="landing-actions">
                            @auth
                                <a href="{{ route('books.index') }}" class="landing-main-btn">マイ本棚を見る</a>
                            @else
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="landing-main-btn">無料でアカウント作成</a>
                                @elseif (Route::has('login'))
                                    <a href="{{ route('login') }}" class="landing-main-btn">ログインして始める</a>
                                @endif
                            @endauth
                            <a href="#features" class="landing-ghost-btn">機能を詳しく見る</a>
                        </div>

                        <ul class="landing-metrics" aria-label="サービスの特徴">
                            <li>
                                <strong>1画面</strong>
                                <span>本棚・進捗・メモを一元管理</span>
                            </li>
                            <li>
                                <strong>最短30秒</strong>
                                <span>検索して本をすぐ登録</span>
                            </li>
                            <li>
                                <strong>見える化</strong>
                                <span>積読数と支出がひと目でわかる</span>
                            </li>
                        </ul>
                    </div>

                    <div class="landing-showcase" aria-hidden="true">
                        <article class="landing-card landing-card-main">
                            <p class="landing-card-label">Now Reading</p>
                            <h3>Learn Better Reading</h3>
                            <p class="landing-card-sub">進捗 68% / 読書メモ 12件</p>
                            <div class="landing-progress">
                                <span style="width: 68%"></span>
                            </div>
                        </article>

                        <article class="landing-card landing-card-secondary">
                            <p class="landing-card-label">TSUNDOKU</p>
                            <h3>積読 14冊</h3>
                            <p class="landing-card-sub">今月 +3冊 / 読了 5冊</p>
                        </article>

                        <article class="landing-card landing-card-note">
                            <p class="landing-card-label">Quick Memo</p>
                            <h3>気になる一節を保存</h3>
                            <p class="landing-card-sub">あとで読み返せるようにメモを残す</p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="landing-features" id="features">
                <div class="landing-container">
                    <p class="landing-section-kicker">Why TSUNDOKU Manager</p>
                    <h2>積読を「行動」に変える3つの機能</h2>

                    <div class="landing-feature-grid">
                        <article class="landing-feature-item">
                            <p class="landing-feature-number">01</p>
                            <h3>本棚を一元管理</h3>
                            <p>購入済み・未読・読書中・読了をまとめて管理。ジャンルやメモで絞り込みも簡単です。</p>
                        </article>
                        <article class="landing-feature-item">
                            <p class="landing-feature-number">02</p>
                            <h3>進捗とペースを可視化</h3>
                            <p>読書ログを残すだけで、どこまで読んだかが明確に。読む習慣を止めにくくします。</p>
                        </article>
                        <article class="landing-feature-item">
                            <p class="landing-feature-number">03</p>
                            <h3>積読コストを把握</h3>
                            <p>購入価格を記録すれば、積読にかけた金額がすぐ確認可能。買いすぎ防止にも役立ちます。</p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="landing-flow" id="flow">
                <div class="landing-container">
                    <p class="landing-section-kicker">How It Works</p>
                    <h2>使い方は3ステップだけ</h2>

                    <div class="landing-flow-grid">
                        <article>
                            <span>STEP 1</span>
                            <h3>本を検索して登録</h3>
                            <p>タイトルやISBNで探して、ワンクリックで本棚へ追加。</p>
                        </article>
                        <article>
                            <span>STEP 2</span>
                            <h3>読書状況を更新</h3>
                            <p>未読・読書中・読了を切り替えて、今の読書状況を整理。</p>
                        </article>
                        <article>
                            <span>STEP 3</span>
                            <h3>次に読む本を決める</h3>
                            <p>積読一覧とメモを見ながら、迷わず次の一冊を選択。</p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="landing-cta" id="start">
                <div class="landing-container">
                    <div class="landing-cta-panel">
                        <p class="landing-section-kicker">Start Today</p>
                        <h2>次に読む1冊を、今日決める。</h2>
                        <p>積読を整理して、読書体験を前に進める。<br>TSUNDOKU Managerで始めましょう。</p>
                        <div class="landing-actions">
                            @auth
                                <a href="{{ route('books.index') }}" class="landing-main-btn">本棚を開く</a>
                            @else
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="landing-main-btn">無料で始める</a>
                                @endif
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="landing-ghost-btn">ログインはこちら</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="landing-footer">
            <div class="landing-container">
                <small>&copy; {{ date('Y') }} TSUNDOKU Manager</small>
            </div>
        </footer>
    </body>
</html>
