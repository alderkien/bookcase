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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/books', 'BookController@index')->name('books');
Route::get('/books/create', 'BookController@create')->name('books.create')->middleware('auth');
Route::post('/books/store', 'BookController@store')->name('books.store')->middleware('auth');

Route::get('/authors', 'AuthorController@index')->name('authors');
