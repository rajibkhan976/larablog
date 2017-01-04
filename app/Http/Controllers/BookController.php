<?php

namespace App\Http\Controllers;

use View;
use App\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   public function getIndex()
   {
      //
      $books = Book::with('relAuthor')->get();
      //return view('books.index',compact('books'));
      #print_r($books[0]->relAuthor->name);exit;
      return view('books.book_list')->with('books',$books);
   }
   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create()
   {
      //
      return view('books.create');
   }
   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store(Request $request)
   {
      //
       $book = $request->all();
       Book::create($book);
       return redirect('book');
      
   }
   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function show($id)
   {
      //
       $books = Book::with('relAuthor')->where('id','=',$id)->get();
       return view('books.show')->with('books',$books);
      
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function edit($id)
   {
      //
       $books = Book::with('relAuthor')->where('id','=',$id)->get();
       return view('books.edit')->with('books',$books);
      
   }
   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update(Request $request, $id)
   {
      //
       $bookUpdate = $request->all();
       $book = Book::find($id);
       $book->update($bookUpdate);
       return redirect('book'); 
      
   }
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function destroy($id)
   {
      //
       Book::find($id)->delete();
      return redirect('book');
   }
}
