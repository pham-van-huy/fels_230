<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fielable = [
        'user_id',
        'taget_id',
        'action_type',
    ];
}
