<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;
use App\Models\Type;
use App\Models\Media;
use App\Models\Image;
use App\Models\Content;
use App\Models\Vote;

class Question extends Model
{
    protected $fillable = [ 
        'user_id',
        'title',
        'view_number',
        'best_answer_id' 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function content()
    {
        return $this->morphOne(Content::class, 'contentable');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }
}
