<?php
namespace App\Repositories\Lesson;

interface LessonInterface
{
    public function storeResultOfLesson($inputResults, $categoryId);

    public function getResultOfLesson($collectionResult);
}
