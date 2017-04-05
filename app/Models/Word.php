<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fielable = [
        'category_id',
        'word',
    ];
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
