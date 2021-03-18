<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'LoginController@index')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/change_password', 'ChangePasswordController@index')->name('change_password');

Route::post('/login', 'LoginController@doLogin')->name('login');
Route::post('/change_password', 'ChangePasswordController@doChange')->name('change_password');

Route::resource('dashboard', 'DashboardController');
Route::resource('poll', 'PollController');
Route::resource('vote', 'VoteController');
Route::resource('choice', 'ChoiceController');
Route::resource('user', 'UserController');
