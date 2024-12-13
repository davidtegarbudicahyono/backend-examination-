<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ini_set('memory_limit','1024M');
        $batchSize = 1000; // Jumlah data per batch
        $totalRatings = 500000;

        $bookIds = Book::pluck('id')->toArray();

        for ($i = 0; $i < $totalRatings / $batchSize; $i++) {
            $ratings = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $ratings[] = [
                    'book_id' => fake()->randomElement($bookIds),
                    'rating' => fake()->numberBetween(1, 10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Rating::insert($ratings);
        }

        // Update voter count and average rating
        $this->updateBookRatings();
    }

    /**
     * Update books with voter count and average ratings.
     */
    private function updateBookRatings()
    {
        // Ambil semua buku
        $books = Book::all();

        foreach ($books as $book) {
            // Hitung jumlah voter (rating count)
            $voterCount = Rating::where('book_id', $book->id)->count();

            // Hitung rata-rata rating
            $averageRating = Rating::where('book_id', $book->id)->avg('rating');

            // Update nilai voter dan rata-rata rating di buku
            $book->update([
                'voter' => $voterCount,
                'avarage_rating' => $averageRating ?: 0, // Default 0 jika tidak ada rating
            ]);
        }
    }
}
