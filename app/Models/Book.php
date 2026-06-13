<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'category',
        'cover_image',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}