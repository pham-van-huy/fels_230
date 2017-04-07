<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'word_id',
        'answer',
        'is_correct',
    ];
    
    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
