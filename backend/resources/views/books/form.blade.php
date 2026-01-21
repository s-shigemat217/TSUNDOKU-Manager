<x-header />
<div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">本を登録</h1>
    <a href="/books/" class="inline-flex items-center w-full px-5 py-3 mb-3 mr-1 text-base font-semibold text-white no-underline align-middle bg-blue-600 border border-transparent border-solid rounded-md cursor-pointer select-none sm:mb-0 sm:w-auto hover:bg-blue-700 hover:border-blue-700 hover:text-white focus-within:bg-blue-700 focus-within:border-blue-700">
        一覧を見る<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </a>
</div>
@if(session('message'))
    <div class="message">
        <p class="text-xl font-bold text-green-800">{{ session('message') }}</p>
    </div>
@endif

<form method="GET" action="/books/search">
    <div class="mb-4">
        <label for="q" class="block mb-1 font-bold">本のタイトルを入力</label>
        <input
            type="text"
            name="q"
            id="q"
            placeholder="本のタイトルを入力"
            required
            class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
        >
    </div>
    <button class="btn btn-search" type="submit">検索</button>
</form>
@if(!empty($books))
<h2>検索結果：「{{ $q }}」</h2>

<ul class="mt-16" style="list-style-type: none; padding: 0;">
    @foreach($books as $book)
        @php
            $info = $book['volumeInfo'] ?? [];
        @endphp

        <li style="margin-bottom: 1em;">
            @php
                $thumbnail = $info['imageLinks']['thumbnail'] ?? null;
                if ($thumbnail) {
                    $thumbnail = str_replace('http://', 'https://', $thumbnail);
                }
            @endphp
            <div class="result-image">
                @if($thumbnail)
                    <img src="{{ $thumbnail }}" alt="cover">
                @else
                    <img src="https://placehold.jp/cccccc/ffffff/100x140.png?text=No+Image" alt="no cover">
                @endif
            </div>

            <strong>{{ $info['title'] ?? 'タイトル不明' }}</strong><br>
            著者：{{ $info['authors'][0] ?? '不明' }}<br>
            出版社：{{ $info['publisher'] ?? '不明' }}<br>

            <form method="POST" action="/books/from-api">
                @csrf

                <input type="hidden" name="title" value="{{ $info['title'] ?? '' }}">
                <input type="hidden" name="author" value="{{ $info['authors'][0] ?? '' }}">
                <input type="hidden" name="publisher" value="{{ $info['publisher'] ?? '' }}">
                <input type="hidden" name="published_date" value="{{ $info['publishedDate'] ?? '' }}">
                <input type="hidden" name="cover_image_url" value="{{ $info['imageLinks']['thumbnail'] ?? '' }}">

                <input type="hidden" name="source" value="google_books">
                <input type="hidden" name="source_id" value="{{ $book['id'] }}">

                <button type="submit" class="btn btn-primary">登録</button>

            </form>
        </li>
    @endforeach
</ul>
@endif
<x-footer />
