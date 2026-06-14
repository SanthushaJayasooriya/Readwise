<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalBooks = Book::count();

        $totalReviews = Review::count();

        $pendingReviews = Review::where(
            'status',
            'pending'
        )->count();

        $moderators = User::where(
            'role',
            'moderator'
        )->count();

        return view('dashboard', compact(
            'totalUsers',
            'totalBooks',
            'totalReviews',
            'pendingReviews',
            'moderators'
        ));
    }
}