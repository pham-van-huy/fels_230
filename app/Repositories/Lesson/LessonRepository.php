<?php
namespace App\Repositories\Lesson;

use App\Models\Lesson;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use App\Repositories\Lesson\LessonInterface;

class LessonRepository extends BaseRepository implements LessonInterface
{
    protected $model;

    public function __construct(Lesson $lesson)
    {
        $this->model = $lesson;
    }
}
