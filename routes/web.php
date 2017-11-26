<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('/register', 'UserController@showRegisterForm');
Route::post('/register', 'UserController@addNewUser');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@authenticate');

Route::get('/polls', 'PollController@showAllPolls');
Route::get('/poll/{url}', 'PollController@showOnePoll');
Route::post('/poll/vote', 'PollController@vote');
Route::get('/api/login', 'UserController@isLoggedIn');

Route::middleware('auth')->group(function(){

    Route::get('/profile', 'HomeController@showProfile')->name('profile');
    Route::get('/logout', 'HomeController@loggingOut');
    Route::post('createPoll', 'PollController@createNewPoll');
    Route::get('/api/polls', 'PollController@getPollsFromUser');
    Route::get('/api/user', 'UserController@getCurrentUser');
    Route::post('/api/save', 'UserController@saveChanges');
    Route::get('/api/poll/{id}', 'PollController@getOnePoll');
    Route::delete('/api/delete/post/{id}', 'PollController@deletePoll');

    Route::prefix('poll')->group(function(){
        Route::get('/{id}/edit', 'PollController@editPoll');
        Route::get('/{id}/delete', 'PollController@deletePoll');
    });
});


