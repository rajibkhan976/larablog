<?php

namespace App\Http\Controllers;

use View;
use App\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Cart;

class OrderController extends Controller{
    
    public function postOrder(Request $request)  {
        
        $rules = array('address' => 'required');
        
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()){
            return Redirect::route('cart')->with('error','Address field is required!');
        }
        
        $member_id = Auth::user()->id;
        $address = $request->input('address');
        
        $cart_books = Cart::with('relBooks')->where('member_id', '=', $member_id)->get();
        
        $cart_total = Cart::with('relBooks')->where('member_id', '=', $member_id)->sum('total');
        
        if(!$cart_books){
            return Redirect::route('book')->with('error','Your cart is empty!');
        }
        
        $order = Order::create(
                array(
                 'member_id' => $member_id,
                 'address'   => $address,
                 'total'     => $cart_total
                ));
        
        foreach ($cart_books as $order_books){
            
            $order->orderItems()->attach($order_books->id, array(
                'book_id'=> $order_books->book_id,
                'amount' => $order_books->amount,
                'price'  => $order_books->relBooks->price,
                'total'  => $order_books->relBooks->price * $order_books->amount
            ));
        }
        
        Cart::where('member_id','=',$member_id)->delete();
        
        return Redirect::route('book')->with('message','Your order processed successfully!');
    }
    
    public function getIndex() {
        
        $member_id = Auth::user()->id;
        
        if(Auth::user()->admin){
            
            $orders = Order::with('orderItems')->where('member_id','=',$member_id)->get();
        }
        else{
            $orders = Order::all();
        }
        
        if(!$orders){
            return Redirect::route('index')->with('error','There is no order !');
        }
        
        return View::make('books.order')->with('orders',$orders);
    }
}

