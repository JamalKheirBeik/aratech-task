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

Route::get('/', 'BookController@index', function () {
    return view('home');
});

Route::get('/search', 'BookController@search', function () {
    return view('search');
});

// ajax routes
Route::post('/book/like', 'BookController@like');
Route::post('/book/dislike', 'BookController@dislike');
