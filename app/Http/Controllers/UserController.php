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
use Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller {
    
    public function postLogin(Request $request) {
        
        $email = $request->input('email');
        $password = $request->input('password');
        
        if (Auth::attempt(array('email' => $email, 'password' => $password, 'admin' => 1)))
        {
            return Redirect::route('cart'); 
        }
        else{
            return Redirect::route('book')->with('error', 'Please check your password and email !');
        }
    }
    
    public function getLogout() {
        
        Auth::logout();
        return Redirect::route('book');
    }
}

