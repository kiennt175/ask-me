<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
Route::get('auth/redirect/{provider}', 'SocialLoginController@redirect')->name('login.social.redirect');
Route::get('callback/{provider}', 'SocialLoginController@callback')->name('login.social.callback');
Route::group(['namespace' => 'User'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('{userId}/profile', 'UserController@show')->name('user.show');
        Route::middleware('auth')->group(function () {
            Route::patch('changePassword', 'UserController@changePassword')->name('user.changePassword');
            Route::get('edit', 'UserController@edit')->name('user.edit');
            Route::patch('update', 'UserController@update')->name('user.update');
            Route::get('/questionForm', 'PostController@create')->name('user.showAskForm');
            Route::post('/postQuestion', 'PostController@store')->name('user.postQuestion');
            Route::get('/newsfeed', 'PostController@newsfeed')->name('user.newsfeed');
        });
        Route::post('resetPasswordLink', 'UserController@sendResetPasswordLink')->name('resetPasswordLink');
        Route::get('newPassword/{userId}/{token}', 'UserController@newPassword')->name('newPassword')->middleware('password.new');
        Route::post('resetPassword/{userId}', 'UserController@resetPassword')->name('resetPassword');
    });
    Route::group(['prefix' => 'questions'], function () {
        Route::get('/{questionId}', 'QuestionController@show')->name('questions.show');
        Route::get('/{questionId}/sortBy/{sortBy}', 'QuestionController@showBy')->name('questions.showBy');
        Route::middleware('auth')->group(function () {
            Route::post('{questionId}/vote', 'QuestionController@vote')->name('questions.vote');
            Route::post('{questionId}/createAnswer', 'AnswerController@store')->name('answers.store');
            Route::post('voteAnswer/{answerId}', 'AnswerController@vote')->name('answers.vote');
            Route::post('answer/{answerId}/updateConversation', 'AnswerController@updateConversation')->name('answers.updateConversation');
            Route::post('answer/{answerId}/deleteConversationThread', 'AnswerController@deleteConversationThread')->name('answers.deleteConversationThread');
        });
    });
});
