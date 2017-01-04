<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order_book extends Model {
	
	protected $table = 'order_books';
        
        protected $fillable = [
	'order_id','book_id', 'amount', 'price', 'total'
	];
	
	}

