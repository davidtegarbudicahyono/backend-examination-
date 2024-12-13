<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $batchSize = 100; // Jumlah data per batch
        $totalCategories = 3000;

        for ($i = 0; $i < $totalCategories / $batchSize; $i++) {
            $categories = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $categories[] = [
                    'name' => fake()->word(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            BookCategory::insert($categories);
        }
    }
}
