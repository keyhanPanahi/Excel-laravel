<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\PurchasedBook;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::select('id','price','title','description')->get();
        return view('admin.pages.book.index',compact('books'));
    }

    public function show(Book $book)
    {
        abort_if(!$book->isPurchased(),403 );
        return view('admin.pages.book.show',compact('book'));
    }
    public function library()
    {
        $books = Auth::user()->books;
        return view('admin.pages.book.library',compact('books'));
    }
}
