<?php
namespace App\Repositories\Word;

use DB;
use Auth;
use App\Models\Word;
use App\Models\Category;
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

    public function getWordList()
    {
        return $this->model->with([
            'answers' => function ($query) {
                $query->whereIsCorrect(config('settings.answer.is_correct_answer'));
            },
        ])->orderBy('word', 'ASC')->paginate(config('settings.user.paginate'));
    }

    public function groupWordByAlpha($words)
    {
        $alpha = [];
        foreach ($words as $value) {
            $key = $value->word[0];
            $alpha[$key] = [$value];
        }

        return $alpha;
    }

    public function getWordByFilter($inputs)
    {
        if ($inputs['categoryId'] == 'default') {
            $inputs['categoryId'] = Category::all()->pluck('id');
        } else {
            $inputs['categoryId'] = [$inputs['categoryId']];
        }

        if (!isset($inputs['rdOption'])) {
            $result = $this->model->whereIn('category_id', $inputs['categoryId']);
        }

        if ($inputs['rdOption'] === config('settings.filter.learned')) {
            $idOfWordLearned = $this->listWordIdLearned();
            $result = $this->model
                ->whereIn('id', $idOfWordLearned)
                ->whereIn('category_id', $inputs['categoryId']);
        }

        if ($inputs['rdOption'] === config('settings.filter.no_learned')) {
            $idOfWordLearned = $this->listWordIdLearned();
            $result = $this->model->whereNotIn('id', $idOfWordLearned)
                ->whereIn('category_id', $inputs['categoryId']);
        }

        return $result->where('word', 'like', '%' . $inputs['key'] . '%')
            ->with([
                'answers' => function ($query) {
                    $query->whereIsCorrect(config('settings.answer.is_correct_answer'));
                },
            ])->orderBy('word', 'ASC')->paginate(config('settings.user.paginate'));
    }
}
