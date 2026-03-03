<x-header />

<section class="books-head">
    <div>
        <p class="books-kicker">Book Detail</p>
        <h1>本の詳細</h1>
        <p>基本情報、読書状況、メモをまとめて確認できます。</p>
    </div>
    <div class="books-head-actions">
        <x-button href="{{ route('books.index') }}" variant="outline">一覧へ戻る</x-button>
        <x-button href="{{ route('books.edit', $book) }}" variant="warning">編集する</x-button>
    </div>
</section>

<x-message />

<section class="books-detail-layout">
    <aside class="books-detail-side">
        <article class="books-panel books-cover-panel">
            @if($book->cover_image_url)
                <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }} の表紙" class="books-cover books-cover-large">
            @else
                <img src="https://placehold.jp/cccccc/ffffff/300x424.png?text=No+Image" alt="表紙画像なし" class="books-cover books-cover-large">
            @endif
        </article>

        <article class="books-panel">
            <h2>クイックアクション</h2>
            <div class="books-stack-actions">
                <x-button href="{{ route('books.edit', $book) }}" size="sm" variant="warning">編集</x-button>
                <form method="POST" action="{{ route('books.destroy', $book) }}">
                    @csrf
                    @method('DELETE')
                    <x-button
                        type="submit"
                        size="sm"
                        variant="danger"
                        onclick="return confirm('本当に削除しますか？')"
                    >削除</x-button>
                </form>
            </div>
        </article>
    </aside>

    <div class="books-detail-main">
        <article class="books-panel">
            <h2>基本情報</h2>
            <dl class="books-def-list">
                <dt>タイトル</dt>
                <dd>{{ $book->title }}</dd>
                <dt>著者</dt>
                <dd>{{ $book->author ?? '不明' }}</dd>
                <dt>出版社</dt>
                <dd>{{ $book->publisher ?? '不明' }}</dd>
                <dt>出版日</dt>
                <dd>{{ $book->published_date ?? '不明' }}</dd>
                <dt>ISBN</dt>
                <dd>{{ $book->isbn ?? '不明' }}</dd>
                <dt>ページ数</dt>
                <dd>{{ $book->page_count ?? '不明' }}</dd>
            </dl>
        </article>

        <div class="books-dual-grid">
            <article class="books-panel">
                <h2>購入・読書情報</h2>
                <dl class="books-def-list">
                    <dt>購入日</dt>
                    <dd>{{ $book->purchased_date?->format('Y-m-d') ?? $book->created_at->format('Y-m-d') }}</dd>
                    <dt>購入金額</dt>
                    <dd>{{ $book->purchase_price ? number_format($book->purchase_price) . '円' : '未設定' }}</dd>
                    <dt>読書開始日</dt>
                    <dd>{{ $book->reading_started_date?->format('Y-m-d') ?? '未設定' }}</dd>
                    <dt>読書終了日</dt>
                    <dd>{{ $book->reading_finished_date?->format('Y-m-d') ?? '未設定' }}</dd>
                </dl>
            </article>

            <article class="books-panel">
                <h2>カテゴリー情報</h2>
                <dl class="books-def-list">
                    <dt>カテゴリー</dt>
                    <dd>{{ $book->category ?? '未設定' }}</dd>
                    <dt>タグ</dt>
                    <dd>
                        @if($book->tags && count($book->tags) > 0)
                            <div class="books-tags">
                                @foreach($book->tags as $tag)
                                    <span>{{ $tag }}</span>
                                @endforeach
                            </div>
                        @else
                            タグはありません。
                        @endif
                    </dd>
                </dl>
            </article>
        </div>

        <article class="books-panel">
            <h2>読書メモ</h2>
            <div class="books-note">{{ $book->reading_notes ?? '読書メモはありません。' }}</div>
        </article>
    </div>
</section>

<x-footer />
