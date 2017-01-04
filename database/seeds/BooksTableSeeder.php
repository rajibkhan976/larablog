<?php

use App\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

Class BooksTableSeeder extends Seeder {
	
	
	public function run() 
	{
	
	DB::table('books')->delete();
	
	Book::create(array(
	'isbn' => '9780062014535',
	'title' => 'Requiem',
	'author' => 'Selim',
	'publisher' => 'bglobal',
	'image' => 'b.jpg'
	));	
	
	Book::create(array(
	'isbn' => '9780062914536',
	'title' => 'Twilight',
	'author' => 'Reza',
	'publisher' => 'bglobal',
	'image' => 'c.jpg'
	));
	
	Book::create(array(
	'isbn' => '9870076234537',
	'title' => 'Laravel',
	'author' => 'Shahbaj',
	'publisher' => 'bglobal',
	'image' => 'e,jpg'
	));
	
		}
	}
