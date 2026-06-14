<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $books = auth()->user()
            ->favorites()
            ->latest()
            ->get();

        return view('favorites.index', compact('books'));
    }

    public function store(Book $book)
    {
        auth()->user()
            ->favorites()
            ->syncWithoutDetaching([$book->id]);

        return back()->with(
            'success',
            'Book added to favorites.'
        );
    }

    public function destroy(Book $book)
    {
        auth()->user()
            ->favorites()
            ->detach($book->id);

        return back()->with(
            'success',
            'Book removed from favorites.'
        );
    }
}