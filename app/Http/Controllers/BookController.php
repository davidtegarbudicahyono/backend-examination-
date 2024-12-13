<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Jumlah data per halaman, default 10
        $search = $request->input('search', '');   // Pencarian berdasarkan nama buku atau penulis

        // Query buku berdasarkan rata-rata rating tertinggi dan pencarian
        $books = Book::with('author', 'BookCategory')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhereHas('author', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->orderBy('avarage_rating', 'desc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
            ]);

        return view('books.index', compact('books', 'perPage', 'search'));
    }
}


