<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;

class BookCaseController extends Controller
{
        public function books(Request $request)
        {
            $request->flash();
            if($request->has('search')){
                $books = Book::where('name','like',"%".$request->get('search')."%")->paginate(12);
            }else{
                $books = Book::paginate(12);
            }
            
            return view('bookcase/books',['books'=>$books]);
        }

        public function authors()
        {
            $authors = Author::withCount('books')->paginate(6);
            return view('bookcase/authors',['authors'=>$authors]);
        }
}
