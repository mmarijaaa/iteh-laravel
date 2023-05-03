<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\AuthorBookController;
use App\Http\Controllers\GenreBookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});

//ruta za prikazivanje knjige books/id
Route::resource('books',BookController::class);
Route::get('books', [BookController::class, 'index'])->name('books.index');

//ruta za prikazivanje knjiga konkretnog usera
Route::get('/users/{id}/books', [UserBookController::class, 'index'])->name('users.books.index');
Route::resource('users.books', UserBookController::class)->only(['index']);

//rute za prikazivanje usera users/id
Route::get('user/{id}', [UserController::class, 'show']);
Route::resource('users',UserController::class);
Route::get('users', [UserController::class, 'index'])->name('users.index');

//ruta za prikazivanje knjiga odredjenog autora
Route::get('/authors/{id}/books', [AuthorBookController::class, 'index'])->name('authors.books.index');

//ruta za prikazivanje knjiga odredjenog zanra
Route::get('/genres/{id}/books', [GenreBookController::class, 'index'])->name('genres.books.index');