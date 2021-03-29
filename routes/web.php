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
        });
    });
});
