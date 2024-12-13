<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [ 'rating', 'book_id' ];
    // Relasi ke buku
    public function books()
    {
        return $this->belongsTo(Book::class);
    }
}
