<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author_id', 'book_category_id', 'avarage_rating', 'voter'];

    // Relasi ke penulis
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relasi ke kategori
    public function BookCategory()
    {
        return $this->belongsTo(BookCategory::class);
    }

    // Relasi ke rating
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
