@extends('layouts.library', ['title' => 'Dashboard'])

@section('content')

<section class="page-hero">
    <div>
        <p class="eyebrow">Admin Dashboard</p>
        <h1>System Overview</h1>
    </div>
</section>

<div class="books-grid">

    <div class="book-card">
        <div class="book-card__body">
            <h3>Total Users</h3>
            <h1>{{ $totalUsers }}</h1>
        </div>
    </div>

    <div class="book-card">
        <div class="book-card__body">
            <h3>Total Books</h3>
            <h1>{{ $totalBooks }}</h1>
        </div>
    </div>

    <div class="book-card">
        <div class="book-card__body">
            <h3>Total Reviews</h3>
            <h1>{{ $totalReviews }}</h1>
        </div>
    </div>

    <div class="book-card">
        <div class="book-card__body">
            <h3>Pending Reviews</h3>
            <h1>{{ $pendingReviews }}</h1>
        </div>
    </div>

    <div class="book-card">
        <div class="book-card__body">
            <h3>Moderators</h3>
            <h1>{{ $moderators }}</h1>
        </div>
    </div>

</div>

<br><br>

<div class="book-card">
    <div class="book-card__body">

        <h2>Quick Actions</h2>

        <br>

        <a href="/admin/users" class="button button--primary">
            Manage Users
        </a>

        <a href="/moderator/reviews" class="button button--soft">
            Pending Reviews
        </a>

        <a href="/books/create" class="button button--soft">
            Add Book
        </a>

    </div>
</div>

@endsection