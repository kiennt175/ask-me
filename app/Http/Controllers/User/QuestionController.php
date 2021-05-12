<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function show($id)
    {
        $question = Question::with(['images', 'medias', 'votes', 'content', 'user', 'tags', 'answers.comments', 'answers.user', 'answers.votes'])->where('id', $id)->first();
        $answers = Answer::where('question_id', $id)->paginate(5);
        $votedCheck = $question->votes->where('user_id', Auth::id())->first();
        $answerUserIds = [];
        $answerUserNames = [];
        $answerUserAvatars = [];
        $answerContents = [];
        $answerConversations = [];
        $answerVotedCheck = [];
        $answerIds = [];
        foreach ($question->answers as $key => $answer) {
            array_push($answerUserIds, $answer->user->id);
            array_push($answerUserNames, $answer->user->name);
            array_push($answerUserAvatars, $answer->user->avatar);
            array_push($answerContents, $answer->content->content);
            array_push($answerConversations, $answer->conversation->conversation ?? '[]');
            array_push($answerIds, $answer->id);
            if (!$answer->votes->where('user_id', Auth::id())->first()) {
                array_push($answerVotedCheck, 0);
            } else {
                array_push($answerVotedCheck, 1);
            }
        }
        $sortBy = 'oldest';

        return view('question_details', compact(['question', 'answers', 'votedCheck', 'answerUserIds', 'answerUserNames', 'answerUserAvatars', 'answerContents', 'answerConversations', 'answerVotedCheck', 'answerIds', 'sortBy']));
    }

    public function showBy($id, $sortBy)
    {
        $question = Question::with(['images', 'medias', 'votes', 'content', 'user', 'tags', 'answers.comments', 'answers.user', 'answers.votes'])->where('id', $id)->first();
        $allAnswers = Answer::where('question_id', $id)->orderBy($sortBy, 'desc')->orderBy('id', 'asc')->get();
        $answers = Answer::where('question_id', $id)->orderBy($sortBy, 'desc')->orderBy('id', 'asc')->paginate(5);
        $votedCheck = $question->votes->where('user_id', Auth::id())->first();
        $answerUserIds = [];
        $answerUserNames = [];
        $answerUserAvatars = [];
        $answerContents = [];
        $answerConversations = [];
        $answerVotedCheck = [];
        $answerIds = [];
        foreach ($allAnswers as $answer) {
            array_push($answerUserIds, $answer->user->id);
            array_push($answerUserNames, $answer->user->name);
            array_push($answerUserAvatars, $answer->user->avatar);
            array_push($answerContents, $answer->content->content);
            array_push($answerConversations, $answer->conversation->conversation ?? '[]');
            array_push($answerIds, $answer->id);
            if (!$answer->votes->where('user_id', Auth::id())->first()) {
                array_push($answerVotedCheck, 0);
            } else {
                array_push($answerVotedCheck, 1);
            }
        }

        return view('question_details', compact(['question', 'answers', 'votedCheck', 'answerUserIds', 'answerUserNames', 'answerUserAvatars', 'answerContents', 'answerConversations', 'answerVotedCheck', 'answerIds', 'sortBy']));
    }

    public function vote($id)
    {
        $question = Question::with('votes')->where('id', $id)->first();
        $userId = Auth::id();
        $votedCheck = $question->votes->where('user_id', $userId)->first();
        if (!$votedCheck) {
            DB::transaction(function () use ($question, $userId) {
                $question->update([
                    'vote_number' => ++$question->vote_number
                ]);
                $question->votes()->create([
                    'user_id' => $userId
                ]);
                $question->user()->update([
                    'points' => ++$question->user->points
                ]);
            });

            return response()->json(['response' => 1]);
        } else {
            DB::transaction(function () use ($question, $userId) {
                $question->update([
                    'vote_number' => --$question->vote_number
                ]);
                $question->votes()->where('user_id', $userId)->delete();
                $question->user()->update([
                    'points' => --$question->user->points
                ]);
            });
            
            return response()->json(['response' => 0]);
        }
    }
}
