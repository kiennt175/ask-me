<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class CollectionController extends Controller
{
    public function show($collectionId)
    {
        $collection = Collection::with(['questions.user', 'questions.content', 'questions.tags'])->where('id', $collectionId)->first();

        return view('collection', compact('collection'));
    }
}
