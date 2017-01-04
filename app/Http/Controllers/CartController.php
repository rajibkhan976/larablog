<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller {
    
    public function postAddToCart(Request $request) {
        
        $rules = array(
            'amount' => 'required|numeric',
            'book'   => 'required|numeric|exists:books,id'
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails())
        {
            return Redirect::route('index')->with('error', 'The book could not be added to your cart!');
        }
        
        $member_id = Auth::user()->id;
        $book_id = $request->input('book');
        $amount = $request->input('amount');
        
        $book = Book::find($book_id);
        $total = $amount * $book->price;
        
        $count = Cart::where('book_id','=',$book_id)->where('member_id','=',$member_id)->count();
        
        if($count){
            return Redirect::route('cart')->with('error', 'The book is already in your cart!');
        }
        
        Cart::create(
                array(
            'member_id' => $member_id,
            'book_id'   => $book_id,
            'amount'    => $amount,
            'total'     => $total
        ));
        
        return Redirect::route('cart');
    }
    
    public function getIndex(){
        
        $member_id = Auth::id();
        
        $cart_books = Cart::with('relBooks')->where('member_id','=',$member_id)->get();
        
        $cart_total = Cart::with('relBooks')->where('member_id','=',$member_id)->sum('total');
        
        if(!$cart_books){
            return Redirect::route('book')->with('error', 'Your cart is empty!');
        }
        
        return view('books.cart')->with('cart_books',$cart_books)->with('cart_total',$cart_total);
        
    }
    
    public function getDelete($id){
        
        $cart = Cart::find($id)->delete();
        
        return Redirect::route('cart');
    }
}

