<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class UserBookController extends Controller
{
    public function index($user_id) {

        $books = Book::get()->where('user_id',$user_id);
        if(is_null($books)) {
            return response()->json('Data  not found',404);
        }
        return response()->json($books);
    }
}
