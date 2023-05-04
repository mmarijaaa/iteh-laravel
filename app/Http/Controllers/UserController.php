<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $users; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id) 
    {
        $user = User::find($user_id);
        if(is_null($user)) {
            return response()->json('Data not found',404);
        }
        return response()->json($user); 
    }

    public function showByIdRes(User $user) {
        return new UserResource($user);
        //prikazuje na osnovu resursa tj samo name i email
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    public function updateUserById(Request $request, $id) {

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();
        return response()->json($user); 
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
