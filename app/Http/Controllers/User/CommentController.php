<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function store(Request $request, $answerId)
    {
        $newComment = Comment::create([
            'answer_id' => $answerId,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'updated' => 0
        ]);

        return response()->json(['response' => 1, 'time' => $newComment->created_at->diffForHumans(Carbon::now())]);
    }
}
