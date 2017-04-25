<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Word;

class WordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 0; $i < 200; $i++) {
                Word::create([
                    'word' => $faker->word,
                    'category_id' => $category->id,
                    'created_at' => $faker->dateTime($max = 'now'),
                    'updated_at' => $faker->dateTime($max = 'now'),
                ]);
            }
        }
    }
}
