<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $batchSize = 100; // Jumlah data per batch
        $totalAuthors = 1000;

        for ($i = 0; $i < $totalAuthors / $batchSize; $i++) {
            $authors = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $authors[] = [
                    'name' => fake()->name(),
                    'voter' => fake()->numberBetween(100, 1000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Author::insert($authors);
        }
    }
}
