<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'lesson_id',
        'answer_id',
        'word_id',
    ];
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
