<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnswerController extends Controller
{
    public function store(Request $request, $questionId)
    {
        if (!Auth::check()) {
            return response()->json(['response' => -1]); 
        }
        $this->validate($request, 
            [
                'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
                'medias.*' => 'mimetypes:audio/mpeg,video/webm|max:3072'
            ]
	    ); 
        if (!$request->content) {
            return response()->json(['response' => 0]); 
        } 
        $user = Auth::user();
        $answer = null;
        DB::transaction(function () use ($request, $questionId, &$answer, $user) {
            // save answer
            $answer = Answer::create([
                'user_id' => $user->id,
                'question_id' => $questionId
            ]);
            // save content
            $answer->content()->create([
                'content' => $request->content,
                'updated' => 0
            ]);
            // save conversation
            $answer->conversation()->create([
                'conversation' => $request->conversation
            ]);
            // save images
            if ($request->images) {
                foreach ($request->images as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $whereToSaveImage = public_path('images/uploads');
                    $image->move($whereToSaveImage, $imageName);
                    $url = "http://localhost:8000/images/uploads/$imageName" ;
                    $answer->images()->create([
                        'url' => $url
                    ]);
                }
            } 
            // save medias
            if ($request->medias) {
                foreach ($request->medias as $media) {
                    $mediaName = time() . '_' . $media->getClientOriginalName();
                    $whereToSaveMedia = public_path('medias');
                    $media->move($whereToSaveMedia, $mediaName);
                    $url = "http://localhost:8000/medias/$mediaName" ;
                    $answer->medias()->create([
                        'url' => $url
                    ]);
                }
            } 
        });
        $responseData = [
            'response' => 1, 
            'newAnswerId' => $answer->id,
            'questionId' => $questionId,
            'answerUserAvatar' => $user->avatar,
            'answerUserName' => $user->name,
            'answerUserId' => $user->id,
            'answerConversation' => $answer->conversation->conversation,
            'answerContent' => $answer->content->content,
            'time' => $answer->created_at->diffForHumans(Carbon::now()),
            'keyCkeditor' => $answer->id,
        ];
    
        return response()->json($responseData);
    }

    public function vote($id)
    {
        $answer = Answer::with('votes')->where('id', $id)->first();
        $userId = Auth::id();
        $votedCheck = $answer->votes->where('user_id', $userId)->first();
        if (!$votedCheck) {
            DB::transaction(function () use ($answer, $userId) {
                $answer->update([
                    'vote_number' => ++$answer->vote_number
                ]);
                $answer->votes()->create([
                    'user_id' => $userId
                ]);
                $answer->user()->update([
                    'points' => ++$answer->user->points
                ]);
            });

            return response()->json(['response' => 1]);
        } else {
            DB::transaction(function () use ($answer, $userId) {
                $answer->update([
                    'vote_number' => --$answer->vote_number
                ]);
                $answer->votes()->where('user_id', $userId)->delete();
                $answer->user()->update([
                    'points' => --$answer->user->points
                ]);
            });
            
            return response()->json(['response' => 0]);
        }    
    }

    public function updateConversation(Request $request, $answerId)
    {
        $conversation = Conversation::where('answer_id', $answerId)->first();
        $conversation->update([
            'conversation' => $request->conversation
        ]);

        return response()->json(['response' => 1]);
    }

    public function deleteConversationThread(Request $request, $answerId)
    {
        $answer = Answer::find($answerId);
        if ($request->conversation != '[]') {
            DB::transaction(function () use ($answer, $request) {
                $answer->content->update([
                    'content' => $request->answerContent
                ]);
                $answer->conversation->update([
                    'conversation' => $request->conversation
                ]);
            });

            return response()->json(['response' => 1]);
        } else {
            DB::transaction(function () use ($answer, $request) {
                $answer->content->update([
                    'content' => $request->answerContent
                ]);
                $answer->conversation->delete();
            });

            return response()->json(['response' => 0]);
        }
    }
}
