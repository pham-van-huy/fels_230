<?php
namespace App\Repositories\Answer;

interface AnswerInterface
{
    public function getAnswerFromInput($inputs);

    public function updateAnswer($inputs);
}
