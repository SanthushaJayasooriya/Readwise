@extends('layouts.library', ['title' => 'My Favorites'])

@section('content')

<section class="page-hero">
    <div>
        <p class="eyebrow">Favorites</p>
        <h1>My Favorite Books</h1>
    </div>
</section>

@if($books->isEmpty())

    <div class="empty-state">
        <h2>No favorites yet</h2>
        <p>Add books to your favorites list.</p>
    </div>

@else

    <section class="books-grid">

        @foreach($books as $book)

            <article class="book-card">

                <a
                    class="book-cover"
                    href="/books/{{ $book->id }}"
                >
                    @include('books.partials.cover', ['book' => $book])
                </a>

                <div class="book-card__body">

                    <span class="pill">
                        {{ $book->category ?: 'Uncategorized' }}
                    </span>

                    <a
                        class="book-card__title"
                        href="/books/{{ $book->id }}"
                    >
                        {{ $book->title }}
                    </a>

                    <p class="book-card__meta">
                        {{ $book->author }}
                    </p>

                </div>

            </article>

        @endforeach

    </section>

@endif

@endsection