<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getAvatarAttribute($value)
    {
        if (empty($value)) {
            return asset(config('settings.user.path_avatar_default'));
        }

        return preg_match('#^https?#', $value)
            ? $value : asset(config('settings.user.avatar_path') . $value);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'relationships', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'relationships', 'following_id', 'follower_id');
    }
}
