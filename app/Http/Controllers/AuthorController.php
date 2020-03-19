<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
        public function index()
        {
            $authors = Author::withCount('books')->paginate(6);
            return view('author.index',['authors'=>$authors]);
        }
}
