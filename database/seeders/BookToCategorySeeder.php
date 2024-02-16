<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BookToCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = DB::table('books')->pluck('id');
        $categories = DB::table('book_categories')->pluck('id');

        foreach ($books as $book) {
            // Randomly assign a book to one or more categories
            $selectedCategories = $this->getRandomCategories($categories->toArray());
            foreach ($selectedCategories as $category) {
                DB::table('book_to_categories')->insert([
                    'book_id' => $book,
                    'book_category_id' => $category,
                ]);
            }
        }
    }

    private function getRandomCategories($categories)
    {   
        // create random categories for book
        $numCategories = rand(1, count($categories));
        return array_rand($categories, $numCategories);
    }
}
