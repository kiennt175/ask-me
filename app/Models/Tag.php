<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Tag extends Model
{
    protected $fillable = [ 
        'tag' 
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
