<x-header />

<section class="books-head">
    <div>
        <p class="books-kicker">My Library</p>
        <h1>蔵書一覧</h1>
        <p>登録した本を一覧で確認し、次に読む1冊を決めましょう。</p>
    </div>
    <x-button href="{{ route('books.create') }}">本を追加</x-button>
</section>

<x-message />

@if($books->isEmpty())
    <section class="books-empty">
        <h2>まだ本が登録されていません</h2>
        <p>まずは1冊登録して、積読の管理を始めましょう。</p>
        <x-button href="{{ route('books.create') }}" variant="outline">本を検索して登録</x-button>
    </section>
@else
    <ul class="books-grid" aria-label="蔵書一覧">
        @foreach($books as $book)
            <li class="books-item-card">
                <a href="{{ route('books.show', $book) }}" class="books-item-link">
                    <div class="books-cover-wrap">
                        @if($book->cover_image_url)
                            <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }} の表紙" class="books-cover">
                        @else
                            <img src="https://placehold.jp/cccccc/ffffff/300x424.png?text=No+Image" alt="表紙画像なし" class="books-cover">
                        @endif
                    </div>
                    <div class="books-meta">
                        <strong>{{ $book->title }}</strong>
                        <p>著者: {{ $book->author ?? '不明' }}</p>
                        <p>出版社: {{ $book->publisher ?? '不明' }}</p>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
@endif

<x-footer />
