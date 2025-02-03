<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookReview;
use App\Models\User;
use App\Models\Book;
use Faker\Factory as Faker;

class BookReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 20 book reviews
        for ($i = 0; $i < 20; $i++) {
            BookReview::create([
                'book_id' => Book::inRandomOrder()->first()->id, // Random book
                'user_id' => User::inRandomOrder()->first()->id, // Random user
                'rating' => $faker->numberBetween(1, 5),
                'comment' => $faker->text,
            ]);
        }
    }
}
