<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
        public function index(Request $request)
        {
            $request->flash();
            if($request->has('search')){
                $books = Book::where('name','like',"%".$request->get('search')."%")->paginate(12);
            }else{
                $books = Book::paginate(12);
            }
            
            return view('bookcase/books',['books'=>$books]);
        }

        public function create(){
            //
        }

        public function store(Request $request){
            //
        }
}
