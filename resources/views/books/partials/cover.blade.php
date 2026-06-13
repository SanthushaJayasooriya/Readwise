@props([
    'book',
    'variant' => 'card',
])

@php
    $initials = collect(explode(' ', $book->title))
        ->filter()
        ->take(2)
        ->map(fn ($word) => \Illuminate\Support\Str::substr($word, 0, 1))
        ->join('');
@endphp

@if($book->cover_image)
    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }} cover" loading="{{ $variant === 'card' ? 'lazy' : 'eager' }}">
@else
    <div class="cover-placeholder cover-placeholder--{{ $variant }}" aria-label="Placeholder cover for {{ $book->title }}">
        <span class="cover-placeholder__mark">{{ $initials ?: 'RW' }}</span>
        <span class="cover-placeholder__title">{{ \Illuminate\Support\Str::limit($book->title, $variant === 'detail' ? 52 : 34) }}</span>
        <span class="cover-placeholder__author">{{ $book->author ?: 'Unknown author' }}</span>
    </div>
@endif
