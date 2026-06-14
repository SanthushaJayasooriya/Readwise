@extends('layouts.library', ['title' => 'Pending Reviews'])

@section('content')

<section class="page-hero">
    <div>
        <p class="eyebrow">Moderator Panel</p>
        <h1>Pending Reviews</h1>
    </div>
</section>

@if(session('success'))
    <div style="
        background:#dcfce7;
        color:#166534;
        padding:12px;
        border-radius:8px;
        margin-bottom:20px;
    ">
        {{ session('success') }}
    </div>
@endif

@if($reviews->count() === 0)

    <div class="empty-state">
        <h2>No Pending Reviews</h2>
        <p>All submitted reviews have been processed.</p>
    </div>

@else

    <div class="books-grid">

        @foreach($reviews as $review)

            <div class="book-card">

                <div class="book-card__body">

                    <span class="pill">
                        {{ $review->book->title }}
                    </span>

                    <h3 style="margin-top:15px;">
                        {{ $review->user->name }}
                    </h3>

                    <p>
                        Rating:
                        <strong>{{ $review->rating }}/5</strong>
                    </p>

                    <p>
                        {{ $review->review }}
                    </p>

                    <div class="card-actions">

                        <form method="POST"
                              action="/moderator/reviews/{{ $review->id }}/approve">
                            @csrf
                            <button
                                type="submit"
                                class="button button--primary">
                                Approve
                            </button>
                        </form>

                        <form method="POST"
                              action="/moderator/reviews/{{ $review->id }}/reject">
                            @csrf
                            <button
                                type="submit"
                                class="button button--danger">
                                Reject
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

@endif

@endsection