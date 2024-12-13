<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        // Ambil data penulis yang memiliki jumlah voter > 5
        $authors = Author::withCount([
            'books as total_voter' => function($query) {
                $query->whereHas('ratings', function($q) {
                    $q->where('rating', '>', 5);
                });
            }
        ])
        ->orderByDesc('total_voter')
        ->take(10)
        ->get();

        return view('authors.index', compact('authors'));
    }
}
