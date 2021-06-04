<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/create_index', function() {
    \App\Models\Question::addAllToIndex();

    return dd("indexed");
});
Route::get('/resetQuestion', function () {
    \App\Models\Question::where('id', '!=', null)->update([
        'best_answer_id' => null,
        'solved_at' => null
    ]);

    return dd('reseted');
});
Route::get('/testSchedule', function () {
    $scheduleQuestions = \App\Models\Question::with('user')->where('schedule_time', '<=', Carbon\Carbon::now())->get();
    $scheduleQuestions->each->update(['status' => 1]);
    $questionIds = $scheduleQuestions->pluck('id')->toArray();
    $userIds = [];
    foreach ($scheduleQuestions as $scheduleQuestion) {
        dd(['question_id' => $scheduleQuestion->id]);
    }
    dd($userIds);
});

Auth::routes();
Route::get('auth/redirect/{provider}', 'SocialLoginController@redirect')->name('login.social.redirect');
Route::get('callback/{provider}', 'SocialLoginController@callback')->name('login.social.callback');
Route::group(['namespace' => 'User'], function () {
    Route::get('{username}', 'UserController@showBy')->name('user.showBy');
    Route::group(['prefix' => 'user'], function () {
        Route::get('{userId}/profile', 'UserController@show')->name('user.show');
        Route::middleware('auth')->group(function () {
            Route::patch('changePassword', 'UserController@changePassword')->name('user.changePassword');
            Route::get('edit', 'UserController@edit')->name('user.edit');
            Route::patch('update', 'UserController@update')->name('user.update');
            Route::get('/questionForm', 'PostController@create')->name('user.showAskForm');
            Route::post('/postQuestion', 'PostController@store')->name('user.postQuestion');
            Route::get('/newsfeed', 'PostController@newsfeed')->name('user.newsfeed');
            Route::get('/pendingQuestions', 'PostController@pending')->name('user.pending');
        });
        Route::post('resetPasswordLink', 'UserController@sendResetPasswordLink')->name('resetPasswordLink');
        Route::get('newPassword/{userId}/{token}', 'UserController@newPassword')->name('newPassword')->middleware('password.new');
        Route::post('resetPassword/{userId}', 'UserController@resetPassword')->name('resetPassword');
    });
    Route::get('{userId}/newsfeed', 'UserController@newsfeed')->name('user.newsfeedBy');
    Route::group(['prefix' => 'questions'], function () {
        // Route::get('search/{searchText}', 'QuestionController@search')->name('questions.search');
        Route::get('/view', 'QuestionController@view')->name('questions.view');
        Route::get('/view/{searchText}/{tab}', 'QuestionController@viewByTab')->name('questions.viewByTab');
        Route::get('/{questionId}', 'QuestionController@show')->name('questions.show');
        Route::get('/{questionId}/sortBy/{sortBy}', 'QuestionController@showBy')->name('questions.showBy');
        Route::middleware('auth')->group(function () {
            Route::post('{questionId}/vote', 'QuestionController@vote')->name('questions.vote');
            Route::post('{questionId}/createAnswer', 'AnswerController@store')->name('answers.store');
            Route::post('voteAnswer/{answerId}', 'AnswerController@vote')->name('answers.vote');
            Route::post('answer/{answerId}/updateConversation', 'AnswerController@updateConversation')->name('answers.updateConversation');
            Route::post('answer/{answerId}/deleteConversationThread', 'AnswerController@deleteConversationThread')->name('answers.deleteConversationThread');
            Route::patch('{questionId}/bestAnswer', 'QuestionController@bestAnswer')->name('questions.best');
            Route::post('answer/{answerId}/addComment', 'CommentController@store')->name('comments.store');
            Route::get('{questionId}/delete', 'QuestionController@destroy')->name('questions.destroy');
            Route::get('{questionId}/edit', 'QuestionController@edit')->name('questions.edit')->middleware('question.edit');;
            Route::post('{questionId}/update', 'QuestionController@update')->name('questions.update');
        });
    });
    Route::group(['prefix' => 'tags'], function () {
        Route::get('/view/{tab}', 'TagController@view')->name('tags.view');
        Route::get('/search/{searchText}/{tab}', 'TagController@search')->name('tags.search');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/view/{tab}', 'UserController@view')->name('users.view');
        Route::get('/search/{searchText}/{tab}', 'UserController@search')->name('users.search');
    });
});
