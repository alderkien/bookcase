<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;

class BookController extends Controller
{
        public function index(Request $request)
        {
            $request->flash();
            $books = Book::search($request->get('search'))->paginate(12);
            return view('book.index',['books'=>$books]);
        }

        public function create(){
            $authors=Author::all();
            return view('book.create',['authors'=>$authors]);
        }

        public function store(Request $request){

            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'isbn' => 'required',
                'authors' => 'required',
            ]);
    
            $book = new Book([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'isbn' => $request->get('isbn'),
            ]);
            $book->save();
            $book->authors()->attach($request->get('authors'));
            return redirect('/books')->with('success', 'Книга добавлена.');
        }
}
