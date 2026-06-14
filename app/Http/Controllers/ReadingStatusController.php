<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReadingStatus;
use Illuminate\Http\Request;

class ReadingStatusController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'status' => 'required|in:want_to_read,reading,completed',
        ]);

        ReadingStatus::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'book_id' => $book->id,
            ],
            [
                'status' => $request->status,
            ]
        );

        return back()->with(
            'success',
            'Reading status updated.'
        );
    }

    public function index()
    {
        $wantToRead = ReadingStatus::where(
            'user_id',
            auth()->id()
        )
        ->where('status', 'want_to_read')
        ->with('book')
        ->get();

        $reading = ReadingStatus::where(
            'user_id',
            auth()->id()
        )
        ->where('status', 'reading')
        ->with('book')
        ->get();

        $completed = ReadingStatus::where(
            'user_id',
            auth()->id()
        )
        ->where('status', 'completed')
        ->with('book')
        ->get();

        return view(
            'reading-status.index',
            compact(
                'wantToRead',
                'reading',
                'completed'
            )
        );
    }
}
