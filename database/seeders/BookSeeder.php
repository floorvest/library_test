<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('books')->insert([
                'book_id' => Str::uuid()->toString(),
                'title' => $faker->sentence,
                'author' => $faker->name,
                'isbn' => $faker->unique()->randomNumber(9),
                'genre' => $faker->word,
                'publication_year' => $faker->year,
                'publisher' => $faker->company,
                'edition' => $faker->word,
                'language' => $faker->languageCode,
                'format' => $faker->word,
                'number_of_pages' => $faker->numberBetween(50, 500),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
