<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Lesson\LessonInterface;
use App\Repositories\Result\ResultInterface;

class ResultController extends Controller
{
    protected $lessonRepository;
    protected $resultRepository;
    protected $dataView;

    public function __construct(
        LessonInterface $lessonRepository,
        ResultInterface $resultRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->resultRepository = $resultRepository;
    }

    public function store(Request $request, $categoryId)
    {
        $inputResult = $request->except('_token');
        $collectionResult = $this->lessonRepository->storeResultOfLesson($inputResult, $categoryId);
        $this->dataView['result'] = $this->lessonRepository->getResultOfLesson($collectionResult);

        return view('user.result.index', $this->dataView);
    }

    public function getResult($lessonId)
    {
        $collectionResult = $this->resultRepository->where('lesson_id', '=', $lessonId);
        $this->dataView['result'] = $this->lessonRepository->getResultOfLesson(current($collectionResult));

        return view('user.result.index', $this->dataView);
    }
}
