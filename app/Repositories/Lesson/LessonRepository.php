<?php
namespace App\Repositories\Lesson;

use Auth;
use DB;
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

    public function storeResultOfLesson($inputResults, $categoryId)
    {
        $inputLesson = [
            'user_id' => auth()->id(),
            'category_id' => $categoryId,
        ];
        $inputActivities = [
            'user_id' => auth()->id(),
            'action_type' => 'lesson',
        ];
        $dataInputs = [];

        foreach ($inputResults as $key => $value) {
            $dataInputs[] = [
                'word_id' => $key,
                'answer_id' => $value,
            ];
        }

        DB::beginTransaction();

        try {
            $lesson = $this->model
                ->create($inputLesson);
            $result = $lesson->results()
                ->createMany($dataInputs);
            $lesson->activity()->create($inputActivities);
            DB::commit();

            return $result;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getResultOfLesson($collectionResult)
    {
        $mark = 0;

        foreach ($collectionResult as $result) {
            if ($result->answer->is_correct == config('settings.answer.is_correct_answer')) {
                $mark++;
            }
        }

        $data['countIsCorrectWord'] = $mark;
        $dataResultCurrent = current($collectionResult);
        $idLessonCurrent = $dataResultCurrent->lesson_id;
        $words = $this->model->find($idLessonCurrent)->words()->get();
        $data['countWordOfLesson'] = $words->count();

        if ($words) {
            $words->load('answers');

            foreach ($words as $word) {
                $data['datas'][] = [
                    'word' => $word,
                    'id_answer_choiced' => $dataResultCurrent->answer_id,
                ];
                $dataResultCurrent = next($collectionResult);
            }
        }

        return $data;
    }
}
