<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookCategory;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $batchSize = 500; // Jumlah data per batch
        $totalBooks = 100000;

        $authorIds = Author::pluck('id')->toArray();
        $categoryIds = BookCategory::pluck('id')->toArray();

        for ($i = 0; $i < $totalBooks / $batchSize; $i++) {
            $books = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $books[] = [
                    'name' => fake()->sentence(3),
                    'author_id' => fake()->randomElement($authorIds),
                    'book_category_id' => fake()->randomElement($categoryIds),
                    'avarage_rating' => 0, 
                    'voter' => 0, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Book::insert($books);
        }
    }
}
