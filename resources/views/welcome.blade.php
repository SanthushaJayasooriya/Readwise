@extends('layouts.library', ['title' => 'Readwise'])

@section('content')
    <section class="welcome-hero">
        <div class="welcome-hero__content">
            <p class="eyebrow">Readwise Library</p>
            <h1>Keep every book in view.</h1>
            <p>
                Browse, search, filter, and maintain your personal reading collection from one calm library workspace.
            </p>
            <div class="welcome-actions">
                <a class="button button--primary" href="/books">Open Library</a>
                <a class="button button--ghost" href="/books/create">Add Book</a>
            </div>
        </div>
    </section>
@endsection
