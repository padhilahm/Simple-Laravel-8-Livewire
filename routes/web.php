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
        return view('home');
    });
Route::get('/post', function () {
        return view('post');
    });

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/register', function () {
        return view('register');
    });

});

Route::middleware(['auth'])->group(function () {
    Route::get('/posts', function () {
        return view('posts');
    });
});

Route::middleware(['admin'])->group(function () {
    Route::get('/users', function () {
        return view('users');
    });

    Route::get('/categories', function () {
        return view('categories');
    });

});
