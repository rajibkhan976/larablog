<?php

namespace App\Http\Controllers;

use View;
use Auth;
use App\Book;
use App\Author;
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
       if(Auth::check()){
       return view('books.create');
       }
       else{
           return redirect('book');
       }
   }
   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store(Request $request)
   {
      //
       $isbn = $request->input('isbn');
       $title = $request->input('title');
       $author_name = $request->input('name');
       $author_surname = $request->input('surname');
       $publisher = $request->input('publisher');
       $image = $request->input('image');
       $price = $request->input('price');
       $author = Author::create(array('name' => $author_name, 'surname' => $author_surname));
       $author_id = $author->id;
       Book::create(array('isbn' => $isbn, 
           'title' => $title, 
           'author' => $author_name, 
           'publisher' => $publisher, 
           'image' => $image, 
           'price' => $price, 
           'author_id' => $author_id));
       
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
       if(Auth::check()){
       $books = Book::with('relAuthor')->where('id','=',$id)->get();
       return view('books.edit')->with('books',$books);
       }
       else{
           return redirect('book');
       }
      
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
       $author = Author::find($book['author_id']);
       $book->update($bookUpdate);
       $author->update(array('name' => $request->input('author')));
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
       if(Auth::check()){
       Book::find($id)->delete();
      return redirect('book');
       }
       else{
           return redirect('book');
       }
   }
}
