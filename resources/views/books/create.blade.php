@extends('layouts.library', ['title' => 'Add Book'])

@section('content')

<section class="page-hero">
    <div>
        <p class="eyebrow">Library</p>
        <h1>Add New Book</h1>
    </div>
</section>

<div class="book-card" style="max-width:700px;margin:auto;">
    <div class="book-card__body">

        <form method="POST" action="/books" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label class="field__label">Title</label>
                <input type="text" name="title" required>
            </div>

            <br>

            <div class="field">
                <label class="field__label">Author</label>
                <input type="text" name="author" required>
            </div>

            <br>

            <div class="field">
                <label class="field__label">Category</label>
                <select name="category">
                    <option value="">Select Category</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Science">Science</option>
                    <option value="Biography">Biography</option>
                    <option value="History">History</option>
                    <option value="Technology">Technology</option>
                    <option value="Education">Education</option>
                </select>
            </div>

            <br>

            <div class="field">
                <label class="field__label">Description</label>
                <textarea
                    name="description"
                    rows="5"
                    style="padding:10px;border:1px solid #ccc;border-radius:8px;"
                ></textarea>
            </div>

            <br>

            <div class="field">
                <label class="field__label">Cover Image</label>
                <input type="file" name="cover_image">
            </div>

            <br><br>

            <button type="submit" class="button button--primary">
                Save Book
            </button>

            <a href="/books" class="button button--soft">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection