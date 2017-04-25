<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Lesson;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $startCategory = Category::orderby('id')->first();
        $endCategory = Category::orderby('id', 'desc')->first();
        $startUser = User::orderby('id')->first();
        $endUser = User::orderby('id', 'desc')->first();

        for ($i = 0; $i < 50; $i++) {
            Lesson::create([
                'category_id' => mt_rand($startCategory->id, $endCategory->id),
                'user_id' => mt_rand($startUser->id, $endUser->id),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
