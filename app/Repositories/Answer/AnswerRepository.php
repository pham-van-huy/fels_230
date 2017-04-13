<?php
namespace App\Repositories\Answer;

use App\Models\Answer;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;

class AnswerRepository extends BaseRepository implements AnswerInterface
{
    protected $model;

    public function __construct(Answer $answer)
    {
        $this->model = $answer;
    }

    public function getAnswerFromInput($inputs)
    {
        if (!$inputs) {
            return [];
        }

        foreach ($inputs as $key => $value) {
            if (!isset($value['is_correct'])) {
                $inputs[$key]['is_correct'] = config('settings.answer.not_correct_answer');
            }
        }

        return $inputs;
    }
}
