<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'taget_id',
        'action_type',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'taget_id');
    }
}
