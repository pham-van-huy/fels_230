<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fielable = [
        'follower_id',
        'following_id',
    ];
}
