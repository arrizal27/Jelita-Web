<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\{AuthController};

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
    return view('dashboard');
});

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
});

//route login
Route::get('/login', 'AuthController@getlogin')->name('login')->middleware('guest');
Route::post('/login','AuthController@postlogin')->middleware('guest');

Route::get('users', function () {
    return view('users');
});