<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Lesson\LessonInterface;

class ResultController extends Controller
{
    protected $lessonRepository;
    protected $dataView;

    public function __construct(LessonInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function store(Request $request, $categoryId)
    {
        $inputResult = $request->except('_token');
        $collectionResult = $this->lessonRepository->storeResultOfLesson($inputResult, $categoryId);
        $this->dataView['result'] = $this->lessonRepository->getResultOfLesson($collectionResult);

        return view('user.result.index', $this->dataView);
    }
}
