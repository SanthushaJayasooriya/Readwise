<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'google_book_id',
        'title',
        'author',
        'isbn',
        'description',
        'category',
        'cover_image',
        'published_year',
        'average_rating',
        'review_count',
    ];
}