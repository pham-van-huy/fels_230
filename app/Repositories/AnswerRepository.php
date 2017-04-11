<?php
namespace App\Repositories;

use Auth;
use App\Models\Answer;
use App\Models\Word;

class AnswerRepository
{
    public function __contruct(Answer $answer)
    {
        $this->model = $answer;
    }

    public function index()
    {
        return $this->model->paginate(20);
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
