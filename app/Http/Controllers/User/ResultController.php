<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Lesson\LessonInterface;

class ResultController extends Controller
{
    protected $lessonRepository;

    public function __construct(LessonInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function store(Request $request, $idCategory)
    {
        $inputResult = $request->except(['_token', 'idCategory']);
        $collectionResult = $this->lessonRepository->storeResultOfLesson($inputResult, $idCategory);
        $resultLesson = $this->lessonRepository->getResultOfLesson($collectionResult);
    }
}
