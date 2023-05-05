<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$users = Book::skip(2)->take(4)->get();
        //$users = Book::count();
        $books = Book::all(); 
        return $books;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createNewBook(Request $request) {
        
        $book = new Book();

        $book->name = $request->input('name');
        $book->author_id = $request->input('author_id');
        $book->genre_id = $request->input('genre_id');
        $book->description = $request->input('description');
        $book->user_id = $request->input('user_id');
        $book->year = $request->input('year');

        $book->save();
        return response()->json($book);   

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //ogranicenja unesenih podataka
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'author_id' => 'required',
            'genre_id' => 'required',
            'description' => 'required|string|max:200',
            'year'=>'required'
        ]);

        //ako nije uspesna validacija
        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        //ako je uspesna ubacuju se podaci za novu knjigu
        $book = Book::create([
            'name' => $request->name,
            'author_id' => $request->author_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'year'=>$request->year,
            'user_id'=>Auth::user()->id
        ]);

        return response()->json(['Book is succesfully created by user', new BookResource($book)]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'author_id' => 'required',
            'genre_id' => 'required',
            'description' => 'required|max:200',
            'year'=>'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $book->name = $request->name;
        $book->author_id = $request->author_id;
        $book->genre_id = $request->genre_id;
        $book->description = $request->description;
        $book->year = $request->year;

        $book->save();

        return response()->json(['Book is succesfully updated by user', new BookResource($book)]);
    }

    public function updateBookById(Request $request, $id) {

        $book = Book::find($id);
        $book->name = $request->input('name');
        $book->author_id = $request->input('author_id');
        $book->genre_id = $request->input('genre_id');
        $book->description = $request->input('description');

        $book->save();
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['Book is succesfully deleted by user']);
    }
}
