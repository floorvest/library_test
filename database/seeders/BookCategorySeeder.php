<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Science Fiction', 'description' => 'Books that explore speculative and futuristic concepts.'],
            ['name' => 'Mystery', 'description' => 'Books focused on solving a mysterious event or crime.'],
            ['name' => 'Fantasy', 'description' => 'Books set in imaginary worlds with magical elements.'],
            ['name' => 'Romance', 'description' => 'Books centered around romantic relationships.'],
            ['name' => 'Biography', 'description' => 'Books detailing the life of a real person.'],
            ['name' => 'History', 'description' => 'Books covering historical events and periods.'],
            ['name' => 'Thriller', 'description' => 'Books with intense, suspenseful plots.'],
            ['name' => 'Self-Help', 'description' => 'Books providing advice and strategies for personal growth.'],
            ['name' => 'Business', 'description' => 'Books focused on business and entrepreneurship.'],
            ['name' => 'Travel', 'description' => 'Books about travel experiences and destinations.'],
            ['name' => 'Science', 'description' => 'Books exploring scientific principles and discoveries.'],
            ['name' => 'Cooking', 'description' => 'Books featuring recipes and culinary techniques.'],
            ['name' => 'Art', 'description' => 'Books about visual arts, including painting and sculpture.'],
            ['name' => 'Poetry', 'description' => 'Books containing poetic works and expressions.'],
            ['name' => 'Drama', 'description' => 'Books with intense and emotional storytelling.'],
            ['name' => 'Comedy', 'description' => 'Books aimed at providing humor and amusement.'],
            ['name' => 'Philosophy', 'description' => 'Books delving into philosophical concepts and ideas.'],
            ['name' => 'Psychology', 'description' => 'Books exploring the human mind and behavior.'],
            ['name' => 'Technology', 'description' => 'Books on technological advancements and innovations.'],
            ['name' => 'Environment', 'description' => 'Books addressing environmental issues and conservation.'],
            // Add more categories as needed
        ];

        DB::table('book_categories')->insert($categories);
    }
}
