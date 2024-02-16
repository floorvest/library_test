<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BookCategoryController;
use App\Http\Controllers\Api\BorrowSystemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::namespace('App\Http\Controllers\Api')
->middleware(['json.response', 'cors'])
->group(function() {

    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/register', 'AuthController@register');

    Route::group(['middleware' => "auth:api"], function() {
        // book resource
        Route::resource('book', BookController::class);

        Route::post('book/link', [BookController::class, 'linkCategory']);
        Route::post('book/link/remove', [BookController::class, 'removeCategory']);

        // book category resource
        Route::resource('category', BookCategoryController::class);

        // borrow system controller
        Route::prefix('system')->group( function() {
            Route::get('books/borrowed', 'BorrowSystemController@borrowedBooks');
            Route::get('books/returned', 'BorrowSystemController@returnedBooks');
            Route::get('books/late', 'BorrowSystemController@lateBooks');

            Route::post('books/borrow', 'BorrowSystemController@borrowBooks');
            Route::post('books/return', 'BorrowSystemController@returnBooks');
        });
    });
});


