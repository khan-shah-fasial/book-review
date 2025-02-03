<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define an array of available image filenames (you can expand this)
        $imageFiles = [
            'assets/books/book1.jpg',
            'assets/books/book2.jpg',
            'assets/books/book3.jpg',
            'assets/books/book4.jpg',
            'assets/books/book5.jpg'
        ];
    
        // Create 5 books with random images
        for ($i = 0; $i < 30; $i++) {
            Book::create([
                'book_name' => $faker->sentence(3),
                'author' => $faker->name,
                'description' => $faker->paragraph,
                'image' => $faker->randomElement($imageFiles),
            ]);
        }
    }
}
