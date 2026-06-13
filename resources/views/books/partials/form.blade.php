@php
    $categoryOptions = [
        'Fiction',
        'Non-Fiction',
        'Science',
        'Technology',
        'Business',
        'Self-Help',
        'Biography',
        'History',
        'Education',
        'Fantasy',
        'Mystery',
        'Romance',
    ];
@endphp

<div class="form-grid">
    <label class="field">
        <span class="field__label">Book Title</span>
        <input type="text" name="title" value="{{ old('title', optional($book)->title) }}" required>
        @error('title')
            <span class="field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="field">
        <span class="field__label">Author</span>
        <input type="text" name="author" value="{{ old('author', optional($book)->author) }}" required>
        @error('author')
            <span class="field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="field">
        <span class="field__label">Category</span>
        <select name="category">
            <option value="">Select Category</option>
            @foreach($categoryOptions as $categoryOption)
                <option value="{{ $categoryOption }}" @selected(old('category', optional($book)->category) === $categoryOption)>
                    {{ $categoryOption }}
                </option>
            @endforeach
        </select>
        @error('category')
            <span class="field__error">{{ $message }}</span>
        @enderror
    </label>

    <label class="field">
        <span class="field__label">Book Cover Image</span>
        <input type="file" name="cover_image" accept="image/*">
        <span class="field__hint">Accepted formats: JPG, JPEG, PNG, or WebP. Maximum size: 2 MB.</span>
        @error('cover_image')
            <span class="field__error">{{ $message }}</span>
        @enderror
    </label>
</div>

@if(optional($book)->cover_image)
    <div class="current-cover">
        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }} cover">
        <div>
            <span>Current cover</span>
            <strong>{{ $book->title }}</strong>
        </div>
    </div>
@endif

<label class="field">
    <span class="field__label">Description</span>
    <textarea name="description" rows="7">{{ old('description', optional($book)->description) }}</textarea>
    @error('description')
        <span class="field__error">{{ $message }}</span>
    @enderror
</label>

<div class="form-actions">
    <a class="button button--ghost" href="/books">Cancel</a>
    <button class="button button--primary" type="submit">{{ $submitLabel }}</button>
</div>
