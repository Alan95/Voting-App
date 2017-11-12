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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', 'HomeController@showProfile')->name('profile');
    Route::get('/logout', 'HomeController@loggingOut');
    Route::post('createPoll', 'PollController@createNewPoll');
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@authenticate');

Route::get('/register', 'UserController@showRegisterForm');
Route::post('/register', 'UserController@addNewUser');

Route::get('/polls', 'PollController@showAllPolls');


