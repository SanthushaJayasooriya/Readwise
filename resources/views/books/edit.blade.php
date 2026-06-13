@extends('layouts.library', ['title' => 'Edit Book | Readwise'])

@section('content')
    <section class="form-page">
        <div class="form-intro">
            <p class="eyebrow">Edit Book</p>
            <h1>Update {{ $book->title }}.</h1>
        </div>

        <div class="form-card">
            @if ($errors->any())
                <div class="alert alert--error">
                    <strong>Please check the form.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/books/{{ $book->id }}" enctype="multipart/form-data" class="book-form">
                @csrf
                @method('PUT')

                @include('books.partials.form', ['book' => $book, 'submitLabel' => 'Update Book'])
            </form>
        </div>
    </section>
@endsection
