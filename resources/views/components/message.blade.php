@if(session('message'))
    <div class="books-flash">
        <p>{{ session('message') }}</p>
    </div>
@endif
