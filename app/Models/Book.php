<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['book_name','author', 'description', 'image'];

    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }
}
