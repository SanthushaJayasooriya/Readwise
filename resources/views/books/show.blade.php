@extends('layouts.library', ['title' => $book->title . ' | Readwise'])

@section('content')

<article class="detail-layout">

```
<div class="detail-cover">
    @include('books.partials.cover', [
        'book' => $book,
        'variant' => 'detail'
    ])
</div>

<div class="detail-panel">

    <a class="back-link" href="/books">
        Back to Library
    </a>

    <span class="pill">
        {{ $book->category ?: 'Uncategorized' }}
    </span>

    <h1>{{ $book->title }}</h1>

    <p class="detail-author">
        {{ $book->author ?: 'Unknown author' }}
    </p>

    {{-- FAVORITES --}}
    @auth

        @if(auth()->user()->favorites->contains($book->id))

            <form
                action="/books/{{ $book->id }}/favorite"
                method="POST"
                style="margin-bottom:20px;"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="button button--danger"
                >
                    Remove from Favorites
                </button>
            </form>

        @else

            <form
                action="/books/{{ $book->id }}/favorite"
                method="POST"
                style="margin-bottom:20px;"
            >
                @csrf

                <button
                    type="submit"
                    class="button button--primary"
                >
                    ⭐ Add to Favorites
                </button>
            </form>

        @endif

    @endauth

    {{-- READING STATUS --}}
    @auth

        <form
            action="/books/{{ $book->id }}/status"
            method="POST"
            style="margin-bottom:20px;"
        >
            @csrf

            <label>
                <strong>Reading Status</strong>
            </label>

            <select
                name="status"
                onchange="this.form.submit()"
                style="
                    width:100%;
                    padding:10px;
                    margin-top:5px;
                "
            >
                <option value="want_to_read">
                    Want To Read
                </option>

                <option value="reading">
                    Reading
                </option>

                <option value="completed">
                    Completed
                </option>
            </select>

        </form>

    @endauth

    <div class="detail-meta">

        @if(!empty($book->published_year))
            <div>
                <span>Published</span>
                <strong>{{ $book->published_year }}</strong>
            </div>
        @endif

        @if(!empty($book->isbn))
            <div>
                <span>ISBN</span>
                <strong>{{ $book->isbn }}</strong>
            </div>
        @endif

        @if(!is_null($book->average_rating))
            <div>
                <span>Rating</span>
                <strong>{{ $book->average_rating }}</strong>
            </div>
        @endif

    </div>

    <section class="description-block">

        <h2>Description</h2>

        <p>
            {{ $book->description ?: 'No description available.' }}
        </p>

    </section>

    @if(session('success'))

        <div
            style="
                background:#dcfce7;
                padding:12px;
                border-radius:10px;
                margin-bottom:20px;
            "
        >
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div
            style="
                background:#fee2e2;
                color:#991b1b;
                padding:12px;
                border-radius:10px;
                margin-bottom:20px;
            "
        >
            {{ session('error') }}
        </div>

    @endif

    <section class="description-block">

        <h2>Reviews</h2>

        @auth

            <form
                action="/books/{{ $book->id }}/reviews"
                method="POST"
            >
                @csrf

                <div style="margin-bottom:15px;">

                    <label>
                        <strong>Rating</strong>
                    </label>

                    <select
                        name="rating"
                        required
                        style="
                            width:100%;
                            padding:10px;
                            margin-top:5px;
                        "
                    >
                        <option value="">
                            Select Rating
                        </option>

                        <option value="5">
                            ⭐⭐⭐⭐⭐ (5)
                        </option>

                        <option value="4">
                            ⭐⭐⭐⭐ (4)
                        </option>

                        <option value="3">
                            ⭐⭐⭐ (3)
                        </option>

                        <option value="2">
                            ⭐⭐ (2)
                        </option>

                        <option value="1">
                            ⭐ (1)
                        </option>

                    </select>

                </div>

                <div style="margin-bottom:15px;">

                    <label>
                        <strong>Your Review</strong>
                    </label>

                    <textarea
                        name="review"
                        rows="4"
                        required
                        style="
                            width:100%;
                            padding:10px;
                        "
                    ></textarea>

                </div>

                <button
                    class="button button--primary"
                    type="submit"
                >
                    Submit Review
                </button>

            </form>

        @else

            <p>
                Please
                <a href="/login">login</a>
                to submit a review.
            </p>

        @endauth

        <hr style="margin:25px 0;">

        @forelse($reviews as $review)

            <div
                style="
                    margin-bottom:20px;
                    padding-bottom:20px;
                    border-bottom:1px solid #ddd;
                "
            >
                <strong>
                    {{ $review->user->name }}
                </strong>

                <div style="margin:8px 0;">
                    Rating: {{ $review->rating }}/5
                </div>

                <p>
                    {{ $review->review }}
                </p>

                <small>
                    {{ $review->created_at->diffForHumans() }}
                </small>

            </div>

        @empty

            <p>
                No approved reviews yet.
            </p>

        @endforelse

    </section>

    @auth

        @if(auth()->user()->role === 'admin')

            <div class="detail-actions">

                <a
                    class="button button--primary"
                    href="/books/{{ $book->id }}/edit"
                >
                    Edit Book
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
```

</article>
@endsection
