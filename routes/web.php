<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('books','BookController');

// Admin Interface Routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
  // Backpack\CRUD: Define the resources for the entities you want to CRUD.
    CRUD::resource('tag', 'Admin\TagCrudController');
  
  // [...] other routes
});


Auth::routes();

Route::get('/home', 'HomeController@index');

#Route::get('/book',['middleware' => 'guest', 'uses' => 'BookController@getIndex']);

#Route::get('auth/register', 'AuthAuthController@getRegister');
#Route::post('auth/register', 'AuthAuthController@postRegister');
#Route::get('auth/login', 'AuthAuthController@getLogin');
Route::post('user/login', 'UserController@postLogin');
Route::get('user/logout', 'UserController@getLogout');

Route::get('/book', array('before'=>'auth.basic', 'as' => 'book', 'uses' => 'BookController@getIndex'));
Route::resource('books','BookController');

Route::get('/cart', array('before'=>'auth.basic','as'=>'cart','uses'=>'CartController@getIndex'));
Route::post('/cart/add',array('before'=>'auth.basic','uses'=>'CartController@postAddToCart'));
Route::get('/cart/delete/{id}',array('before'=>'auth.basic','as'=>'delete_book_from_cart','uses'=>'CartController@getDelete'));

Route::post('/order', array('before' => 'auth.basic', 'uses' => 'OrderController@postOrder'));
Route::get('/user/orders', array('before' => 'auth.basic', 'uses' => 'OrderController@getIndex'));
