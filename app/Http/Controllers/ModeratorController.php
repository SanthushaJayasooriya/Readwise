<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function pendingReviews()
    {
        $reviews = Review::with(['book', 'user'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('moderator.reviews', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $review->update([
            'status' => 'approved'
        ]);

        return back()->with(
            'success',
            'Review approved successfully.'
        );
    }

    public function reject(Review $review)
    {
        $review->update([
            'status' => 'rejected'
        ]);

        return back()->with(
            'success',
            'Review rejected successfully.'
        );
    }
}