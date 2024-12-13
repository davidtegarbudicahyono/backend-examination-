<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author; // Tambahkan model Author
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Show the rating form.
     */
    public function create()
    {
        // Fetch authors with their books
        $authors = Author::with('books')->get();
        return view('ratings.create', compact('authors'));
    }

    /**
     * Store the submitted rating.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        // Store the rating
        Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        // Update the book's average rating and voter count
        $book = Book::find($request->book_id);
        $book->increment('voter'); // Tambahkan 1 pada voter
        $book->avarage_rating = Rating::where('book_id', $book->id)->avg('rating'); // Hitung ulang rata-rata
        $book->save();

        // Redirect to the book list
        return redirect()->route('books.index')->with('success', 'Rating submitted successfully.');
    }
}
