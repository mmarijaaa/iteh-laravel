<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all(); 
        return $genres;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function createNewGenre(Request $request) {

        $genre = new Genre();

        $genre->genrename = $request->input('genrename');

        $genre->save();
        return response()->json($genre);    
    } 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'genrename' => 'required|string|max:30',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $genre = Genre::create([
            'genrename' => $request->genrename,
            'user_id'=>Auth::user()->id
        ]);

        return response()->json(['Genre is succesfully created by user', new GenreResource($genre)]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return new GenreResource($genre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $validator = Validator::make($request->all(), [
            'genrename' => 'required|string|max:70',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $genre->genrename = $request->genrename; 

        $genre->save();

        return response()->json(['Genre is succesfully updated by user', new GenreResource($genre)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json(['Genre is succesfully deleted by user']);
    }
}
