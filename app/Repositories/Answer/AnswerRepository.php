<?php
namespace App\Repositories\Answer;

use App\Models\Answer;
use App\Models\Word;
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

    public function updateOrCreateAnswer($wordId, $inputs)
    {
        $inputsAnswer = $this->getAnswerFromInput($inputs);

        foreach ($inputsAnswer as $answerId => $answer) {
            $this->model->updateOrCreate(['word_id' => $wordId, 'id' => $answerId], $answer);
        }

        return true;
    }

    public function deleteAnswers($wordId, $requestAnswerUpdate)
    {
        $answerId = Word::find($wordId)->answers()->get()->pluck('id');
        $answerIdOfRequest = array_keys($requestAnswerUpdate);

        $answerIdDelete = [];

        foreach ($answerId as $id) {
            if (!in_array($id, $answerIdOfRequest, true)) {
                $answerIdDelete[] = $id;
            }
        }

        if (!$answerIdDelete) {
            return true;
        }

        return $this->model->whereIn('id', $answerIdDelete)->delete();
    }
}
