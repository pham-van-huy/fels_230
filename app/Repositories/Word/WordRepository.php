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
