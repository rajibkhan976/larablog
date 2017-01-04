<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
	
	protected $table = 'carts';
	
	protected $fillable = [
	'member_id', 'book_id', 'amount', 'total'
	];
	
	public function relBooks() {
		
		return $this->belongsTo('App\Book', 'book_id', 'id');
		}
	}
