<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', 'BooksController@index');
Route::get('book/{isbn}', 'BooksController@findByISBN');
Route::get('book/checkisbn/{isbn}', 'BooksController@checkISBN');
Route::get('books/search/{searchTerm}', 'BooksController@findBySearchTerm');
//Route::post('book', 'BooksController@save');
//Route::put('book/{isbn}', 'BooksController@update');
//Route::delete('book/{isbn}', 'BooksController@delete');

Route::post('auth/login', 'Auth\ApiAuthController@login');

Route::group(['middleware' => ['api','cors','jwt.auth']], function () {
    Route::post('book', 'BooksController@save');
    Route::put('book/{isbn}', 'BooksController@update');
    Route::delete('book/{isbn}', 'BooksController@delete');
    Route::post('auth/logout', 'Auth\ApiAuthController@logout');
});
