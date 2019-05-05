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

Route::get('books', 'BookController@index');
Route::get('book/{isbn}', 'BookController@findByISBN');
Route::get('book/id/{id}', 'BookController@findBookByID');
Route::get('book/checkisbn/{isbn}', 'BookController@checkISBN');
Route::get('books/search/{searchTerm}', 'BookController@findBySearchTerm');
//Route::post('book', 'BookController@save');
//Route::put('book/{isbn}', 'BookController@update');
//Route::delete('book/{isbn}', 'BookController@delete');

Route::post('auth/login', 'Auth\ApiAuthController@login');

Route::get('orders', 'OrderController@index');
Route::get('order/{id}', 'OrderController@findByOrderID');
Route::get('user/{id}', 'OrderController@findOrdersByUserID');

Route::group(['middleware' => ['api','cors','jwt.auth']], function () {
    Route::post('book', 'BookController@save');
    Route::put('book/{isbn}', 'BookController@update');
    Route::delete('book/{isbn}', 'BookController@delete');
    Route::post('auth/logout', 'Auth\ApiAuthController@logout');
});
