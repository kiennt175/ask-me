<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Media;
use App\Models\Image;
use App\Models\Content;
use App\Models\Vote;
use App\Models\Comment;

class Answer extends Model
{
    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function contents()
    {
        return $this->morphOne(Content::class, 'contentable');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
