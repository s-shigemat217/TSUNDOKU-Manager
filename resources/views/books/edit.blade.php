<x-header />

<section class="books-head">
    <div>
        <p class="books-kicker">Edit Book</p>
        <h1>本の情報を編集</h1>
        <p>タイトルや購入情報、読書メモを更新できます。</p>
    </div>
    <x-button href="{{ route('books.show', $book) }}" variant="outline">詳細へ戻る</x-button>
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

<section class="books-form-panel">
    <form method="POST" action="{{ route('books.update', $book) }}" class="books-form-grid">
        @csrf
        @method('PATCH')

        <div class="books-field books-field-full">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $book->title) }}">
        </div>

        <div class="books-field">
            <label for="author">著者</label>
            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}">
        </div>

        <div class="books-field">
            <label for="publisher">出版社</label>
            <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}">
        </div>

        <div class="books-field">
            <label for="published_date">出版日</label>
            <input type="text" name="published_date" id="published_date" value="{{ old('published_date', $book->published_date) }}" placeholder="例: 2025-04-10">
        </div>

        <div class="books-field">
            <label for="page_count">ページ数</label>
            <input type="number" name="page_count" id="page_count" min="1" value="{{ old('page_count', $book->page_count) }}">
        </div>

        <div class="books-field">
            <label for="purchased_date">購入日</label>
            <input type="date" name="purchased_date" id="purchased_date" value="{{ old('purchased_date', optional($book->purchased_date)->format('Y-m-d')) }}">
        </div>

        <div class="books-field">
            <label for="purchase_price">購入金額</label>
            <input type="number" name="purchase_price" id="purchase_price" min="0" step="1" value="{{ old('purchase_price', $book->purchase_price) }}" placeholder="例: 1500">
        </div>

        <div class="books-field">
            <label for="reading_started_date">読書開始日</label>
            <input type="date" name="reading_started_date" id="reading_started_date" value="{{ old('reading_started_date', optional($book->reading_started_date)->format('Y-m-d')) }}">
        </div>

        <div class="books-field">
            <label for="reading_finished_date">読書終了日</label>
            <input type="date" name="reading_finished_date" id="reading_finished_date" value="{{ old('reading_finished_date', optional($book->reading_finished_date)->format('Y-m-d')) }}">
        </div>

        <div class="books-field">
            <label for="category">カテゴリー</label>
            <input type="text" name="category" id="category" value="{{ old('category', $book->category) }}">
        </div>

        <div class="books-field">
            <label for="tags">タグ（カンマ区切り）</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags', $book->tags ? implode(', ', $book->tags) : '') }}" placeholder="例: エッセイ, 哲学">
        </div>

        <div class="books-field books-field-full">
            <label for="reading_notes">読書メモ</label>
            <textarea name="reading_notes" id="reading_notes" rows="7">{{ old('reading_notes', $book->reading_notes) }}</textarea>
        </div>

        <div class="books-submit-row">
            <x-button type="submit">保存する</x-button>
        </div>
    </form>
</section>

<x-footer />
