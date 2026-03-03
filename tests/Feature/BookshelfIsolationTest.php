<?php

use App\Models\Book;
use App\Models\User;

function sampleBookPayload(string $title, string $sourceId): array
{
    return [
        'title' => $title,
        'source' => 'google_books',
        'source_id' => $sourceId,
    ];
}

test('users only see their own books in index', function () {
    $alice = User::factory()->create();
    $bob = User::factory()->create();

    Book::create([
        'user_id' => $alice->id,
        'title' => 'Alice Book',
        'status' => 'owned',
    ]);

    Book::create([
        'user_id' => $bob->id,
        'title' => 'Bob Book',
        'status' => 'owned',
    ]);

    $response = $this->actingAs($alice)->get(route('books.index'));

    $response->assertOk();
    $response->assertSee('Alice Book');
    $response->assertDontSee('Bob Book');
});

test('users cannot access another users book detail', function () {
    $alice = User::factory()->create();
    $bob = User::factory()->create();

    $bobsBook = Book::create([
        'user_id' => $bob->id,
        'title' => 'Private Book',
        'status' => 'owned',
    ]);

    $response = $this->actingAs($alice)->get(route('books.show', $bobsBook));

    $response->assertNotFound();
});

test('stored books are linked to the authenticated user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->from(route('books.create'))
        ->post(route('books.store'), sampleBookPayload('My New Book', 'src-001'));

    $response->assertRedirect(route('books.create'));
    $response->assertSessionHas('message', '登録しました');

    $this->assertDatabaseHas('books', [
        'user_id' => $user->id,
        'title' => 'My New Book',
        'source' => 'google_books',
        'source_id' => 'src-001',
    ]);
});

test('duplicate check is isolated per user', function () {
    $alice = User::factory()->create();
    $bob = User::factory()->create();

    Book::create([
        'user_id' => $alice->id,
        'title' => 'Shared Source Book',
        'source' => 'google_books',
        'source_id' => 'shared-source',
        'status' => 'owned',
    ]);

    $this->actingAs($bob)
        ->from(route('books.create'))
        ->post(route('books.store'), sampleBookPayload('Shared Source Book', 'shared-source'))
        ->assertSessionHas('message', '登録しました');

    expect(Book::where('source', 'google_books')->where('source_id', 'shared-source')->count())
        ->toBe(2);

    $this->actingAs($bob)
        ->from(route('books.create'))
        ->post(route('books.store'), sampleBookPayload('Shared Source Book', 'shared-source'))
        ->assertSessionHas('message', 'すでに登録されています');

    expect(Book::where('user_id', $bob->id)->where('source_id', 'shared-source')->count())
        ->toBe(1);
});
