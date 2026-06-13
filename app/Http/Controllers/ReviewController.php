<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['required', 'string'],
        ]);

        Review::create([
            'book_id' => $book->id,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Review submitted and awaiting approval.'
        );
    }
}