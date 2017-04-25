<?php
namespace App\Repositories\Answer;

interface AnswerInterface
{
    public function getAnswerFromInput($inputs);

    public function updateOrCreateAnswer($wordId, $inputs);

    public function deleteAnswers($wordId, $requestAnswerUpdate);
}
