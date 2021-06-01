<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Provider;
use App\Models\Role;
use App\Models\Question;
use App\Models\Vote;
use App\Models\Comment;
use App\Models\Answer;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'bio', 
        'avatar', 
        'website_link', 
        'points', 
        'reset_password_token',
        'username',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function questions() 
    {
        return $this->hasMany(Question::class);
    }

    public function votes() 
    {
        return $this->hasMany(Vote::class);
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

    public function answers() 
    {
        return $this->hasMany(Answer::class);
    }
}
