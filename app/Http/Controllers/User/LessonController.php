<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Lesson\LessonInterface;
use App\Repositories\Word\WordInterface;

class LessonController extends Controller
{
    protected $lessonRepository;
    protected $wordRepository;

    public function __construct(
        LessonInterface $lessonRepository,
        WordInterface $wordRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->wordRepository = $wordRepository;
    }

    public function lessontest($idcategory)
    {
        $words = $this->wordRepository->getWordUnlearnedForLesson($idcategory);
        return view('user.lesson.lessontest', ['words' => $words, 'idCategory' => $idcategory]);
    }
}
