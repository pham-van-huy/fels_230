<?php
namespace App\Repositories\Lesson;

use Auth;
use App\Models\Lesson;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class LessonRepository extends BaseRepository implements LessonInterface
{
    protected $model;

    public function __construct(Lesson $lesson)
    {
        $this->model = $lesson;
    }

    public function storeResultOfLesson($inputResults, $idCategory)
    {
        $inputLesson = [
            'user_id' => Auth::user()->id,
            'category_id' => $idCategory,
        ];

        foreach ($inputResults as $key => $value) {
            $dataInputs[] = [
                'word_id' => $key,
                'answer_id' => $value,
            ];
        }

        return $this->model
            ->create($inputLesson)
            ->results()
            ->createMany($dataInputs);
    }

    public function getResultOfLesson($collectionResult)
    {
        $idlLesson = current($collectionResult)->id;
        $results = $this->model->find($idlLesson)->results()->get();

        //count answer correct
        $numberAnswerCorrect = 0;

        foreach ($results as $result) {

            if ($result->answer->is_correct == 1) {
                $numberAnswerCorrect++
            }
        }

        $data['numberAnswerCorrect'] = $numberAnswerCorrect;

        $data['numberWordOfLesson'] = $this->model->find($idlLesson)->result()->get()->count();
    }
}
