<?php

use Illuminate\Database\Seeder;

use App\Models\Word;
use App\Models\Lesson;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Category;

class ResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::all();
        $idCategorArray = Category::all()->pluck('id')->all();

        foreach ($lessons as $lesson) {
            $wordRand = Word::inRandomOrder()
                ->whereCategoryId($idCategorArray[array_rand($idCategorArray, 1)])
                ->take(20)
                ->get();

            foreach ($wordRand as $word) {
                $result = new Result;
                $result->lesson_id = $lesson->id;
                $idAnswerArray = Answer::whereWordId($word->id)
                    ->get()
                    ->pluck('id')
                    ->all();
                $result->word_id = $word->id;
                $result->answer_id = $idAnswerArray[array_rand($idAnswerArray, 1)];
                $result->save();
            }
        }
    }
}
