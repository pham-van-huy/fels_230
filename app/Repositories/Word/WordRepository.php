<?php
namespace App\Repositories\Word;

use DB;
use Auth;
use App\Models\Word;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class WordRepository extends BaseRepository implements WordInterface
{
    protected $model;

    public function __construct(Word $word)
    {
        $this->model = $word;
    }

    public function storeWordAndAnswers($input)
    {
        DB::beginTransaction();
        try {
            $data = $this->model
                ->create(array_only($input, ['word', 'category_id']))
                ->answers()->createMany($input['ans']);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getWordUnlearnedForLesson($categoryId)
    {
        $listIdWordLearned = $this->listWordIdLearned();
        return $this->model
            ->whereNotIn('id', $listIdWordLearned)
            ->whereCategoryId($categoryId)
            ->inRandomOrder()
            ->with('answers')
            ->take(config('settings.word.limit_words_random'))
            ->get();
    }

    public function listWordIdLearned()
    {
        $allLesson = $this->answerCorrect();

        if ($allLesson->isEmpty()) {
            return [];
        }

        foreach ($allLesson as $lesson) {
            foreach ($lesson->answers as $answer) {
                $idWord[] = $answer->word_id;
            }
        }

        return array_unique($idWord);
    }

    public function answerCorrect()
    {
        $allLesson = Auth::user()
            ->lessons()
            ->orderBy('category_id', 'asc')
            ->whereHas('answers', function ($query) {
                $query->whereIsCorrect(config('settings.answer.is_correct_answer'));
            })
            ->get()
            ->load(['answers' => function ($query) {
                $query->whereIsCorrect(config('settings.answer.is_correct_answer'));
            },
            ]);

        return $allLesson;
    }
}
