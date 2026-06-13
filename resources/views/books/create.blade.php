@extends('layouts.library', ['title' => 'Add Book | Readwise'])

@section('content')
    <section class="form-page">
        <div class="form-intro">
            <p class="eyebrow">New Book</p>
            <h1>Add a book to your library.</h1>
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

            <form action="/books" method="POST" enctype="multipart/form-data" class="book-form">
                @csrf

                @include('books.partials.form', ['book' => null, 'submitLabel' => 'Save Book'])
            </form>
        </div>
    </section>
@endsection
