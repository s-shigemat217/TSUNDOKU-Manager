<x-header />

@php
    $searchResults = $books ?? [];
@endphp

<section class="books-head">
    <div>
        <p class="books-kicker">Add New Book</p>
        <h1>本を登録</h1>
        <p>タイトル検索して、見つけた本をワンクリックで本棚に追加できます。</p>
    </div>
    <x-button href="{{ route('books.index') }}" variant="outline">一覧を見る</x-button>
</section>

<x-message />

@if ($errors->any())
    <div class="books-errors">
        <p>入力内容を確認してください。</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="books-search-panel">
    <form method="GET" action="{{ route('books.search') }}" class="books-search-form">
        <label for="q">本のタイトルを入力</label>
        <div class="books-search-row">
            <input
                type="text"
                name="q"
                id="q"
                value="{{ $q ?? '' }}"
                placeholder="例: 嫌われる勇気"
                required
            >
            <x-button type="submit">検索</x-button>
        </div>
    </form>
</section>

@if(!empty($searchResults))
    <section class="books-result-head">
        <h2>検索結果: 「{{ $q }}」</h2>
    </section>

    @php
        $registeredSourceIdMap = isset($registeredSourceIds) ? array_flip($registeredSourceIds) : [];
    @endphp

    <ul class="books-grid" aria-label="検索結果一覧">
        @foreach($searchResults as $book)
            @php
                $info = $book['volumeInfo'] ?? [];
                $sourceId = $book['id'] ?? null;
                $isRegistered = $sourceId && isset($registeredSourceIdMap[$sourceId]);
                $thumbnail = $info['imageLinks']['thumbnail'] ?? null;
                if ($thumbnail) {
                    $thumbnail = str_replace('http://', 'https://', $thumbnail);
                }
            @endphp

            <li class="books-item-card">
                <div class="books-cover-wrap">
                    @if($thumbnail)
                        <img src="{{ $thumbnail }}" alt="{{ $info['title'] ?? 'タイトル不明' }} の表紙" class="books-cover">
                    @else
                        <img src="https://placehold.jp/cccccc/ffffff/300x424.png?text=No+Image" alt="表紙画像なし" class="books-cover">
                    @endif
                </div>

                <div class="books-meta">
                    <strong>{{ $info['title'] ?? 'タイトル不明' }}</strong>
                    <p>著者: {{ $info['authors'][0] ?? '不明' }}</p>
                    <p>出版社: {{ $info['publisher'] ?? '不明' }}</p>
                </div>

                <form method="POST" action="{{ route('books.store') }}" class="books-item-action">
                    @csrf

                    <input type="hidden" name="title" value="{{ $info['title'] ?? '' }}">
                    <input type="hidden" name="author" value="{{ $info['authors'][0] ?? '' }}">
                    <input type="hidden" name="publisher" value="{{ $info['publisher'] ?? '' }}">
                    <input type="hidden" name="published_date" value="{{ $info['publishedDate'] ?? '' }}">
                    <input type="hidden" name="cover_image_url" value="{{ $thumbnail ?? '' }}">
                    <input type="hidden" name="source" value="google_books">
                    <input type="hidden" name="source_id" value="{{ $sourceId }}">

                    @if($isRegistered)
                        <x-button type="button" size="sm" variant="muted" disabled>登録済み</x-button>
                    @else
                        <x-button type="submit" size="sm">登録</x-button>
                    @endif
                </form>
            </li>
        @endforeach
    </ul>
@endif

<x-footer />
