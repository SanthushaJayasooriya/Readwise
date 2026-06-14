@extends('layouts.library', ['title' => 'My Reading List'])

@section('content')

<section class="page-hero">
    <div>
        <p class="eyebrow">Reading Progress</p>
        <h1>My Reading List</h1>
    </div>
</section>

<div style="margin-bottom:40px;">

    <h2>📚 Want To Read</h2>

    @forelse($wantToRead as $item)

        <div style="background:white;padding:15px;margin-bottom:10px;border-radius:10px;">
            <a href="/books/{{ $item->book->id }}">
                {{ $item->book->title }}
            </a>
        </div>

    @empty

        <p>No books in this list.</p>

    @endforelse

</div>

<div style="margin-bottom:40px;">

    <h2>📖 Currently Reading</h2>

    @forelse($reading as $item)

        <div style="background:white;padding:15px;margin-bottom:10px;border-radius:10px;">
            <a href="/books/{{ $item->book->id }}">
                {{ $item->book->title }}
            </a>
        </div>

    @empty

        <p>No books in this list.</p>

    @endforelse

</div>

<div>

    <h2>✅ Completed</h2>

    @forelse($completed as $item)

        <div style="background:white;padding:15px;margin-bottom:10px;border-radius:10px;">
            <a href="/books/{{ $item->book->id }}">
                {{ $item->book->title }}
            </a>
        </div>

    @empty

        <p>No books in this list.</p>

    @endforelse

</div>

@endsection