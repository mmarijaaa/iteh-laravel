<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all(); 
        return $authors; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
    public function createNewAuthor(Request $request) {  

        $author = new Author();

        $author->authorname = $request->input('authorname'); 

        $author->save();
        return response()->json($author);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'authorname' => 'required|string|max:70',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $author = Author::create([
            'authorname' => $request->authorname,
            'user_id'=>Auth::user()->id
        ]);

        return response()->json(['Author is succesfully created by user', new AuthorResource($author)]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validator = Validator ::make($request->all(), [
            'authorname' => 'required|string|max:70',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $author->authorname = $request->authorname; 

        $author->save();

        return response()->json(['Author is succesfully updated by user', new AuthorResource($author)]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(['Author is succesfully deleted by user']);
    }
}
