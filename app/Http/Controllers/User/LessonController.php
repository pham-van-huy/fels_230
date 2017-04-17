<?php

namespace App\Http\Controllers\User;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Lesson\LessonInterface;
use App\Repositories\Word\WordInterface;
use App\Repositories\Result\ResultInterface;

class LessonController extends Controller
{
    protected $lessonRepository;
    protected $wordRepository;
    protected $resultRepository;

    public function __construct(
        LessonInterface $lessonRepository,
        WordInterface $wordRepository,
        ResultInterface $resultRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->wordRepository = $wordRepository;
        $this->resultRepository = $resultRepository;
    }

    public function index($idCategory)
    {
        $wordsInLesson = $this->wordRepository->getWordForLesson($idCategory);

        return view('user.lesson.index', ['wordsInLesson' => $wordsInLesson]);
    }
}
