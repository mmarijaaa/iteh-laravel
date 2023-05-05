<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\AuthorBookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
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

//ruta za prikazivanje knjige po id-ju /books/id
//Route::resource('books',BookController::class);

//ruta za prikaivanje svih knjiga /books
//Route::get('books', [BookController::class, 'index'])->name('books.index');


//ruta za prikazivanje knjiga konkretnog usera /users/3/books
/*Route::get('/users/{id}/books', [UserBookController::class, 'index'])->name('users.books.index');
Route::resource('users.books', UserBookController::class)->only(['index']);


//ruta za prikazivanje usera users/id
Route::get('user/{id}', [UserController::class, 'show']);

//ruta za prikazivanje liste usera ILI usera po id-ju
Route::resource('users',UserController::class); 

//ruta za prikazivanje liste usera 
Route::get('users', [UserController::class, 'index'])->name('users.index');
*/

/*ruta za azuriranje knjige book/3 i upisivanje params ISTO rade samo zavisi od put/patch 
Route::put('book/{id}', [BookController::class, 'updateBookById']);
Route::patch('book/{id}', [BookController::class, 'updateBookById']);

//rute za azuriranje korisnika user/3 i upisivanje params ISTO rade samo zavisi od put/patch 
Route::put('user/{id}', [UserController::class, 'updateUserById']);
Route::patch('user/{id}', [UserController::class, 'updateUserById']);
*/

/*ruta za dodavanje nove knjige u bazu
Route::post('/createbook', [BookController::class, 'createNewBook']);

//ruta za dodavanje novog autora u bazu
Route::post('/createauthor', [AuthorController::class, 'createNewAuthor']);

//ruta za dodavanje novog zanra u bazu
Route::post('/creategenre', [GenreController::class, 'createNewGenre']); 
*/

//ruta za registraciju
Route::post('/register', [AuthController::class, 'register']);

//ruta za login
Route::post('/login', [AuthController::class, 'login']);


//grupa ruta za pristup funckijama od strane samo autentifikovanog korisnika

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    //rute za kreiranje, izmenu i brisanje objekata 

    Route::resource('books', BookController::class)->only(['update','store','destroy']);

    Route::resource('authors', AuthorController::class)->only(['update','store','destroy']);

    Route::resource('genres', GenreController::class)->only(['update','store','destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

//ovim rutama mogu pristupiti neulogovani korisnici

Route::resource('books', BookController::class)->only(['index']);
Route::resource('authors', AuthorController::class)->only(['index']); 
Route::resource('genres', GenreController::class)->only(['index']);

//ruta za prikazivanje knjiga odredjenog autora authors/3/books
Route::get('/authors/{id}/books', [AuthorBookController::class, 'index'])->name('authors.books.index');

//ruta za prikazivanje knjiga odredjenog zanra genres/3/books
Route::get('/genres/{id}/books', [GenreBookController::class, 'index'])->name('genres.books.index'); 
