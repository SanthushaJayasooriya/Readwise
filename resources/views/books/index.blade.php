@extends('layouts.library', ['title' => 'Readwise Library'])

@section('content')
    <section class="page-hero">
        <div>
            <p class="eyebrow">Personal Library</p>
            <h1>Your books, beautifully organized.</h1>
        </div>

        @auth
            @if(auth()->user()->role === 'admin')
                <a class="button button--primary" href="/books/create">
                    Add Book
                </a>
            @endif
        @endauth
    </section>

    <form class="toolbar" method="GET" action="/books">
        <label class="field field--search">
            <span class="field__label">Search</span>

            <input
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Search by title, author, or category"
            >
        </label>

        <label class="field field--select">
            <span class="field__label">Category</span>

            <select name="category">
                <option value="">All categories</option>

                @foreach($categories as $categoryOption)
                    <option
                        value="{{ $categoryOption }}"
                        @selected($category === $categoryOption)
                    >
                        {{ $categoryOption }}
                    </option>
                @endforeach
            </select>
        </label>

        <div class="toolbar__actions">
            <button
                class="button button--primary"
                type="submit"
            >
                Search
            </button>

            @if($search || $category)
                <a
                    class="button button--ghost"
                    href="/books"
                >
                    Clear
                </a>
            @endif
        </div>
    </form>

    @if($books->isEmpty())

        <section class="empty-state">

            <h2>No books found</h2>

            <p>
                @if($search || $category)
                    Try a different search or category.
                @else
                    Start your library by adding your first book.
                @endif
            </p>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a class="button button--primary" href="/books/create">
                        Add Book
                    </a>
                @endif
            @endauth

        </section>

    @else

        <section
            class="books-grid"
            aria-label="Book library"
        >

            @foreach($books as $book)

                <article class="book-card">

                    <a
                        class="book-cover"
                        href="/books/{{ $book->id }}"
                        aria-label="View {{ $book->title }}"
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
                            {{ $book->author ?: 'Unknown author' }}
                        </p>

                        @auth
                            @if(auth()->user()->role === 'admin')

                                <div class="card-actions">

                                    <a
                                        class="button button--soft"
                                        href="/books/{{ $book->id }}/edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="/books/{{ $book->id }}"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="button button--danger"
                                            type="submit"
                                            onclick="return confirm('Delete this book?')"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </div>

                            @endif
                        @endauth

                    </div>

                </article>

            @endforeach

        </section>

    @endif
@endsection