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

Route::get('dashboard', 'DashboardController@index');
Route::get('users', 'UsersController@index');

//route login
Route::get('login', 'AuthController@getlogin')->name('login');
Route::post('login','AuthController@postlogin')->name('postlogin');
Route::get('logout', 'AuthController@logout');