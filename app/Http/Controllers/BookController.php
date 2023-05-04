<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$users = Book::skip(2)->take(4)->get();
        //$users = Book::count();
        $users = Book::all(); 
        return $users;
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
    public function store(StoreBookRequest $request)
    {
        //
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
    public function update(UpdateBookRequest $request, $id)
    {

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
        //
    }
}
